<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Attribute;
use Livewire\Component;

class SectionAttributes extends Component
{
    public $section;

    public $openModal = false;

    public $item = [
        'attributes' => [
            [
                'type' => '',
                'key' => ''
            ]
        ],
    ];

    public function addAttribute(){

        $this->item['attributes'][] = [
            'type' => '',
            'key' => ''
        ];
    }

    public function removeAttribute($index){

        unset($this->item['attributes'][$index]);
        $this->item['attributes'] = array_values($this->item['attributes']);
    }

    public function deleteAttribute(Attribute $attribute){

        $attribute->delete();

    }

    public function save(){
        $this->validate([
            'item.attributes.*.type' => 'required',
            'item.attributes.*.key' => 'required'
        ]);

        foreach ($this->item['attributes'] as $attribute) {
            $this->section->attributes()->create($attribute);
        }

        $this->reset(['item', 'openModal']);
        
    }
    
    public function render()
    {
        return view('livewire.admin.sections.section-attributes');
    }
}
