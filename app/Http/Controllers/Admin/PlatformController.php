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
    
            $usersQty = DB::table('platform_user')->where('platform_id', $platform->id)->count();
    
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
                'gallery'=> 'required|image|max:1024',
            ]);

        }else if($request->has('camera')){

            $request->validate([
                'camera'=> 'required|image|max:1024',
            ]);

        }else{
            return redirect()->route('platforms.show', $platform)->with('swal', 'error');
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

        return redirect()->route('admin.platforms.show', $platform)->with('swal', 'ok');
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
