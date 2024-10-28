<?php

namespace App\Livewire\Admin\Configurations;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ConfigurationEdit extends Component
{
    public $configuration;
    public $configurationEdit;

    public function mount(){
        $this->configurationEdit = $this->configuration->content;
    }

    public function save(){
        $this->configuration->update([
            'content' => $this->configurationEdit
        ]);

        //DB::table('shoppingcart')->delete();

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Configuración actualizada correctamente.'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.configurations.configuration-edit');
    }
}
