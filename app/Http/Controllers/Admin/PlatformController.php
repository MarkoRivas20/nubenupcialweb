<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImagePlatform;
use App\Models\Platform;
use App\Models\PlatformUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class PlatformController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'can:manage platforms',
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = Platform::orderBy('created_at','desc')->paginate();

        return view('admin.platforms.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.platforms.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Platform $platform)
    {
        $platformUser = PlatformUser::where('user_id', auth()->id())->where('platform_id', $platform->id)->first();
        $userName = Auth::user()->name . ' ' . Auth::user()->last_name;
        $usersQty = null;
        $imagesCount = null;
                
        if ($platformUser) {
            //mandar correctamente a pagina
            $imagesCount =  DB::table('image_platforms')->where('platform_user_id', $platformUser->id)->count();
            return view('admin.platforms.show', compact('platform','userName','imagesCount','usersQty'));
        }else{
    
            $usersQty = DB::table('platform_user')->where('user_id','!=', 1)->where('platform_id', $platform->id)->count();
    
            if($usersQty >= $platform->qty_users){
    
                //mandar correctamente a la pagina pero con un aviso de usuarios completos
                return view('admin.platforms.show', compact('platform','userName','imagesCount','usersQty'));
    
            }else{
                //mandar conrrectamente a pagina
                $platform->users()->attach(auth()->id());
                $platformUser = PlatformUser::where('user_id', auth()->id())->where('platform_id', $platform->id)->first();
                $imagesCount =  DB::table('image_platforms')->where('platform_user_id', $platformUser->id)->count();
                return view('admin.platforms.show', compact('platform','userName','imagesCount','usersQty'));
            }
        }
    }

    public function store(Platform $platform, Request $request){

        if($request->has('gallery')){

            $request->validate([
                'gallery'=> 'required|image',
            ]);

        }else if($request->has('camera')){

            $request->validate([
                'camera'=> 'required|image',
            ]);

        }else{
            return redirect()->route('admin.platforms.show', $platform)->with('swal', 'error');
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
            return redirect()->route('admin.platforms.show', $platform)->with('swal', 'ok');
        }else{
            return redirect()->route('admin.platforms.show', $platform)->with('swal', 'error');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platform $platform)
    {
        return view('admin.platforms.edit', compact('platform'));
    }

    public function images(Platform $platform){
        return view('admin.platforms.images', compact('platform'));
    }

}
