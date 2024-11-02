<?php

namespace App\Livewire\Admin\Resources;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ResourceEdit extends Component
{
    use WithFileUploads;

    public $resource;
 
    public $photos = [];

    public function uploadFiles(){

        $this->validate([
            'photos.*' => 'max:1024', // 1MB Max
        ]);

        foreach ($this->photos as $photo) {

            $url = Storage::put('/resources', $photo);

            $this->resource->images()->create([
                'file_path' => $url
            ]);

        }
        $this->photos = [];
    }

    public function DeleteImage(Image $image){
        Storage::delete($image->file_path);
        $image->delete();
    }

    public function render()
    {
        return view('livewire.admin.resources.resource-edit');
    }
}
