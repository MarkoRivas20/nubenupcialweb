<?php

namespace App\Livewire\Admin\Invitations;

use App\Models\Invitation;
use App\Models\Template;
use Livewire\Component;

class InvitationIndex extends Component
{
    public $invitations;
    public $templates;

    public $openModal = false;

    public $templateSelected = "";

    public function createInvitation(){

        return redirect()->route('admin.invitations.create',$this->templateSelected);
    }

    public function render()
    {
        $this->invitations = Invitation::orderBy('created_at','desc')->get();
        $this->templates = Template::where('status',true)->get();
        return view('livewire.admin.invitations.invitation-index');
    }
}
