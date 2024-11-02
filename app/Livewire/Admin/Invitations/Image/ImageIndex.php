<?php

namespace App\Livewire\Admin\Invitations\Image;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageIndex extends Component
{
    use WithFileUploads;

    public $section;
 
    public $photos = [];

    public function uploadFiles(){

        $this->validate([
            'photos.*' => 'max:1024', // 1MB Max
        ]);

        foreach ($this->photos as $photo) {

            $url = Storage::put('/sections', $photo);

            $this->section->images()->create([
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
        return view('livewire.admin.invitations.image.image-index');
    }
}
