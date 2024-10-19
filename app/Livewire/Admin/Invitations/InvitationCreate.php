<?php

namespace App\Livewire\Admin\Invitations;

use Livewire\Component;

class InvitationCreate extends Component
{
    public $nameSection = "";
    public $openModal = false;
    public $template;

    public $templateSelected = [];

    public function mount(){

        foreach ($this->template->sections as $index=>$section) {
            
            $this->templateSelected[] = [
                'name' => $section->name,
                'body' => $section->body,
                'type_background' => $section->type_background,
                'background' => $section->background,
                'attributes' => []
            ];

            foreach ($section->attributes as $attribute) {
                $this->templateSelected[$index]['attributes'][] = [
                    'type' => $attribute->type,
                    'key' => $attribute->key,
                    'value' => ''
                ];
            }
        }

    }

    public function addSection(){

        $this->templateSelected[] = [
            'name' => $this->nameSection,
            'body' => '',
            'type_background' => '',
            'background' => '',
            'attributes' => []
        ];

        $this->openModal=false;

    }

    public function addAttribute($index){

        $this->templateSelected[$index]['attributes'][] = [
            'type' => '',
            'key' => '',
            'value' => ''
        ];

    }

    public function removeSection($index){

        unset($this->templateSelected[$index]);
        $this->templateSelected = array_values($this->templateSelected);
        
    }

    public function removeAttribute($indexSection, $indexAttribute){

        unset($this->templateSelected[$indexSection]['attributes'][$indexAttribute]);
        $this->templateSelected[$indexSection]['attributes'] = array_values($this->templateSelected[$indexSection]['attributes']);
        
    }

    public function save(){
        dd($this->templateSelected);
    }

    public function render()
    {
        return view('livewire.admin.invitations.invitation-create');
    }
}
