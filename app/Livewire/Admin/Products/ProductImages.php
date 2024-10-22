<?php

namespace App\Livewire\Admin\Products;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductImages extends Component
{
    use WithFileUploads;

    public $product;
    public $openModalImages = false;
    public $photos = [];

    public function uploadPhotos(){

        $this->validate([
            'photos.*' => 'image|max:1024', // 1MB Max
        ]);

        foreach ($this->photos as $photo) {

            $url = Storage::put('/photos', $photo);

            $this->product->images()->create([
                'file_path' => $url
            ]);

        }

        $this->openModalImages = false;
        $this->reset($this->photos);

    }

    public function DeleteImage(Image $image){
        Storage::delete($image->file_path);
        $image->delete();
    }

    public function render()
    {

        return view('livewire.admin.products.product-images');
    }
}
