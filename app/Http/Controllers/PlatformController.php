<?php

namespace App\Http\Controllers;

use App\Models\ImagePlatform;
use App\Models\Platform;
use App\Models\PlatformUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Encoders\WebpEncoder;

class PlatformController extends Controller
{
    public function index(){

        $platforms = Platform::where('user_id', auth()->id())->where('status', true)->paginate();

        return view('platforms.index', compact('platforms'));
    }

    public function show(Platform $platform, $verificationCode){

        if ($platform->status) {
            if ($platform->verification_code == $verificationCode) {

                $platformUser = PlatformUser::where('user_id', auth()->id())->where('platform_id', $platform->id)->first();
                $userName = Auth::user()->name . ' ' . Auth::user()->last_name;
                $usersQty = null;
                $imagesCount = null;
                
                if ($platformUser) {
                    //mandar correctamente a pagina
                    $imagesCount =  DB::table('image_platforms')->where('platform_user_id', $platformUser->id)->count();
                    return view('platforms.show', compact('platform','userName','imagesCount','usersQty'));
                }else{
    
                    $usersQty = DB::table('platform_user')->where('user_id','!=', 1)->where('platform_id', $platform->id)->count();
    
                    if($usersQty >= $platform->qty_users){
    
                        //mandar correctamente a la pagina pero con un aviso de usuarios completos
                        return view('platforms.show', compact('platform','userName','imagesCount','usersQty'));
    
                    }else{
                        //mandar conrrectamente a pagina
                        $platform->users()->attach(auth()->id());
                        $platformUser = PlatformUser::where('user_id', auth()->id())->where('platform_id', $platform->id)->first();
                        $imagesCount =  DB::table('image_platforms')->where('platform_user_id', $platformUser->id)->count();
                        return view('platforms.show', compact('platform','userName','imagesCount','usersQty'));
                    }
                }
            }
    
            return redirect()->route('notfound'); 
           
        }
        return redirect()->route('notfound');
    
    }

    public function store(Platform $platform, $verificationCode ,Request $request){

        if($request->has('gallery')){

            $request->validate([
                'gallery'=> 'required|image',
            ]);

        }else if($request->has('camera')){

            $request->validate([
                'camera'=> 'required|image',
            ]);

        }else{
            return redirect()->route('platforms.show', [$platform, $verificationCode])->with('swal', 'error');
        }
        
        $platformUser = PlatformUser::where('user_id', auth()->id())->where('platform_id', $platform->id)->first();
        $imageName = $platform->id."/".time().Str::random(20).'.jpeg';
        
        if($request->has('gallery')){

            $url = Storage::disk('platforms')->put($imageName,$this->resizeImage($request->file('gallery')));


        }else if($request->has('camera')){

           $url = Storage::disk('platforms')->put($imageName,$this->resizeImage($request->file('camera')));

        }

        if ($url) {
            ImagePlatform::create([
                'url' => $imageName,
                'message' => $request->has('message') ? $request->message : '',
                'platform_user_id' => $platformUser->id
            ]);
            return redirect()->route('platforms.show', [$platform, $verificationCode])->with('swal', 'ok');
        }else{
            return redirect()->route('platforms.show', [$platform, $verificationCode])->with('swal', 'error');
        }
        

    }

    protected function resizeImage($file){

        $sizeInMegabytes = ($file->getSize()/1024)/1024;
        
        $image = ImageManager::gd()->read($file);

        if($sizeInMegabytes <= 1.00){
            return $image->toJpeg();
        }

        // ejemplo 1.5 MB
        $percentReduce = (($sizeInMegabytes - 1.00) * 100) / $sizeInMegabytes;

        $height = $image->height();// 1000
        $width = $image->width(); 

        $newHeight = $height - (($percentReduce * $height) / 100.00);
        $newWidth = $width - (($percentReduce * $width) / 100.00);

        return $image->resize($newWidth, $newHeight)->toJpeg();

    }

    public function download(Platform $platform){

        if (auth()->id() == $platform->user->id) {

            $split = explode(".", $platform->qr);
            return Storage::download($platform->qr, "QR ".$platform->name.".".$split[1]);
            
        }else{
            return redirect()->route('notfound');
        }

    }

    public function details(Platform $platform){

        if (auth()->id() == $platform->user->id) {

            return view('platforms.detail', compact('platform'));
        }else{
            return redirect()->route('notfound');
        }

    }

}
