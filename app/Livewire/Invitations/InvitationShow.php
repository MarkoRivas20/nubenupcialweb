<?php

namespace App\Livewire\Invitations;

use Livewire\Component;

class InvitationShow extends Component
{
    public $invitation;
    public $content = [];

    public function mount(){
        
        foreach ($this->invitation->sections()->orderBy('order','asc')->get() as $section) {
            $body = $section->body;

            foreach ($section->attributes as $attribute) {
                $body = str_replace($attribute->key,$attribute->value,$body);
            }

            $this->content[] = $body;
        }
    }

    public function render()
    {
        return view('livewire.invitations.invitation-show');
    }
}
