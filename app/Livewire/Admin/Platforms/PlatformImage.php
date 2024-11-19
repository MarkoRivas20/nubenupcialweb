<?php

namespace App\Livewire\Admin\Platforms;

use App\Models\ImagePlatform;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class PlatformImage extends Component
{
    use WithPagination;

    public $platform;

    public function DeleteImage(ImagePlatform $imagePlatform){

        Storage::disk('platforms')->delete($imagePlatform->url);
        $imagePlatform->delete();

    }

    public function render()
    {
        $platform = $this->platform;

        $images = ImagePlatform::whereHas('platformUser', function($query) use ($platform){
            $query->where('platform_id', $platform->id);
        })->paginate(10);

        return view('livewire.admin.platforms.platform-image', compact('images'));
    }
}
