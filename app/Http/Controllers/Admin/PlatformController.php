<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Models\PlatformUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                
        if ($platformUser) {
            //mandar correctamente a pagina
            $imagesCount =  DB::table('image_platforms')->where('platform_user_id', $platformUser->id)->count();
            return view('admin.platforms.show', compact('platform','userName','imagesCount'));
        }else{
    
            $users = DB::table('platform_user')->where('platform_id', $platform->id)->get();
    
            if($users->count() >= $platform->qty_users){
    
                return 'lleno';
                //mandar correctamente a la pagina pero con un aviso de usuarios completos
    
            }else{
                //mandar conrrectamente a pagina
                $platform->users()->attach(auth()->id());
                $platformUser = PlatformUser::where('user_id', auth()->id())->where('platform_id', $platform->id)->first();
                $imagesCount =  DB::table('image_platforms')->where('platform_user_id', $platformUser->id)->count();
                return view('admin.platforms.show', compact('platform','userName','imagesCount'));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platform $platform)
    {
        return view('admin.platforms.edit', compact('platform'));
    }

}
