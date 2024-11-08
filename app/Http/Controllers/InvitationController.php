<?php

namespace App\Http\Controllers;

use App\Exports\ConfirmationsExport;
use App\Models\Invitation;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InvitationController extends Controller
{
    public function index(){

        $invitations = Invitation::where('user_id', auth()->id())->where('status', true)->paginate();

        return view('invitations.index', compact('invitations'));
    }

    public function show(Invitation $invitation){

        if ($invitation->status) {
            
            return view('invitations.show', compact('invitation'));
        }

        return redirect()->route('notfound');
    }

    public function confirmations(Invitation $invitation){

        $confirmations = $invitation->confirmations()->paginate();

        return view('invitations.confirmation', compact('invitation','confirmations'));
    }

    public function download(Invitation $invitation){

        $split = explode(".", $invitation->qr);

        return Storage::download($invitation->qr, "QR ".$invitation->name.".".$split[1]);
    }

    public function export(Invitation $invitation) 
    {
        if ($invitation->user->id == auth()->id()) {
            return Excel::download(new ConfirmationsExport, 'confirmaciones.xlsx');
        }
    }
}
