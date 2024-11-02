<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show(Invitation $invitation){

        if ($invitation->status) {
            
            $contenido = [];
    
            foreach ($invitation->sections()->orderBy('order','asc')->get() as $section) {
                $body = $section->body;
    
                foreach ($section->attributes as $attribute) {
                    $body = str_replace($attribute->key,$attribute->value,$body);
                }
    
                $contenido[] = $body;
            }
    
            
            //return view('admin.invitations.index', compact('body','attributes'));
            return view('invitations.show', compact('contenido'));
        }

        return redirect()->route('notfound');
    }
}
