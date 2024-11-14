<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use App\Models\PlatformUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlatformController extends Controller
{
    public function show(Platform $platform, $verificationCode){

        if ($platform->verification_code == $verificationCode) {

            $platformUser = PlatformUser::where('user_id', auth()->id())->where('platform_id', $platform->id)->first();
            $userName = Auth::user()->name . ' ' . Auth::user()->last_name;
            $imagesCount = $platformUser->images->count();

            if ($platformUser) {
                //mandar correctamente a pagina
                
                return view('platforms.show', compact('platform','userName','imagesCount'));
            }else{

                $users = DB::table('platform_user')->where('platform_id', $platform->id)->get();

                if($users->count() >= $platform->qty_users){

                    return 'lleno';
                    //mandar correctamente a la pagina pero con un aviso de usuarios completos

                }else{

                    $platform->users()->attach(auth()->id());
                    return 'creado';
                    //mandar conrrectamente a pagina
                }
            }
        }

        return '0';
    }
}
