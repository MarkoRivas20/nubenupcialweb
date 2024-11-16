<?php

namespace App\Http\Controllers;

use App\Models\ImagePlatform;
use App\Models\Platform;
use App\Models\PlatformUser;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Firebase;
use Illuminate\Support\Str;

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
                
                if ($platformUser) {
                    //mandar correctamente a pagina
                    $imagesCount =  DB::table('image_platforms')->where('platform_user_id', $platformUser->id)->count();
                    return view('platforms.show', compact('platform','userName','imagesCount'));
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
                        return view('platforms.show', compact('platform','userName','imagesCount'));
                    }
                }
            }
    
            return redirect()->route('notfound'); 
           
        }
        return redirect()->route('notfound');
    
    }

    public function store(Platform $platform, $verificationCode ,Request $request){
        
        $request->validate([
            'image'=> 'required|image|max:1024',
        ]);

        $platformUser = PlatformUser::where('user_id', auth()->id())->where('platform_id', $platform->id)->first();

        $url = Storage::disk('platforms')->put($platform->slug,$request->file('image'));

        ImagePlatform::create([
            'url' => $url,
            'message' => $request->has('message') ? $request->message : '',
            'platform_user_id' => $platformUser->id
        ]);

        return redirect()->route('platforms.show', [$platform, $verificationCode])->with('swal', 'Ok');
    }

    public function download(Platform $platform){

        $split = explode(".", $platform->qr);

        return Storage::download($platform->qr, "QR ".$platform->name.".".$split[1]);
    }

}
