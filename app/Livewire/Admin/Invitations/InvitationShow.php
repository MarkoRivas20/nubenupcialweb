<?php

namespace App\Livewire\Admin\Invitations;

use Livewire\Component;

class InvitationShow extends Component
{
    public $invitation;
    public $content = [];

    public $nombre = "";
    public $telefono = "";
    public $confirmacion = "";
    public $mensaje = "";

    public function mount(){
        
        foreach ($this->invitation->sections()->orderBy('order','asc')->get() as $section) {
            $body = $section->body;

            foreach ($section->attributes as $attribute) {
                $body = str_replace($attribute->key,$attribute->value,$body);
            }

            $this->content[] = $body;
        }
    }

    public function addUser(){

        dd([
            $this->nombre,
            $this->telefono,
            $this->confirmacion,
            $this->mensaje,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.invitations.invitation-show');
    }
}
