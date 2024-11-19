<?php

namespace App\Http\Controllers;

use App\Models\ImagePlatform;
use App\Models\Platform;
use App\Models\PlatformUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
    
                    $usersQty = DB::table('platform_user')->where('platform_id', $platform->id)->count();
    
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
                'gallery'=> 'required|image|max:1024',
            ]);

        }else if($request->has('camera')){

            $request->validate([
                'camera'=> 'required|image|max:1024',
            ]);

        }else{
            return redirect()->route('platforms.show', [$platform, $verificationCode])->with('swal', 'error');
        }
        
        $platformUser = PlatformUser::where('user_id', auth()->id())->where('platform_id', $platform->id)->first();

        if($request->has('gallery')){

            $url = Storage::disk('platforms')->put($platform->id,$request->file('gallery'));

        }else if($request->has('camera')){

            $url = Storage::disk('platforms')->put($platform->id,$request->file('camera'));

        }

        ImagePlatform::create([
            'url' => $url,
            'message' => $request->has('message') ? $request->message : '',
            'platform_user_id' => $platformUser->id
        ]);

        return redirect()->route('platforms.show', [$platform, $verificationCode])->with('swal', 'Ok');
    }

    public function download(Platform $platform){

        if (auth()->id() == $platform->user->id) {

            $split = explode(".", $platform->qr);
    
            return Storage::download($platform->qr, "QR ".$platform->name.".".$split[1]);
        }

    }

    public function details(Platform $platform){

        if (auth()->id() == $platform->user->id) {

            return view('platforms.detail', compact('platform'));
        }

    }

}
