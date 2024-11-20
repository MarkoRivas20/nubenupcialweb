<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Confirmation;
use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function save(Request $request){

        $invitation = Invitation::where('slug', $request->get('invitacion'))->first();
     
        if ($invitation->id) {
            
            Confirmation::create([
                'person_name' => $request->get('nombre'),
                'person_phone' => $request->get('telefono'),
                'person_message' => $request->get('mensaje'),
                'person_confirmation' => $request->get('confirmacion'),
                'invitation_id' => $invitation->id
            ]);
     
            return response('OK',200);
        }

       return response('Not found',404);
        
    }

}
