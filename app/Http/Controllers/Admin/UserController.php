<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'can:manage users',
        ];
    }

    public function index(){
       
        return view('admin.users.index');
    }

    public function edit(User $user){
       
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user){

        //dd($request->all());
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Usuario actualizado correctamente.'

        ]);
    }
}
