<?php

namespace App\Livewire\Admin\Platforms;

use App\Models\ImagePlatform;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use ZipStream\ZipStream;

class PlatformImage extends Component
{
    use WithPagination;

    public $platform;

    public function DeleteImage(ImagePlatform $imagePlatform){

        Storage::disk('platforms')->delete($imagePlatform->url);
        $imagePlatform->delete();

    }

    public function download(){
        $platform = $this->platform;
        $images = ImagePlatform::whereHas('platformUser', function($query) use ($platform){
            $query->where('platform_id', $platform->id)->where('user_id','!=', 1);
        })->get();

        return response()->streamDownload(function() use ($images) {

            $zip = new ZipStream(
                outputName: $this->platform->slug.'.zip',
            );

            foreach ($images as $image) {
                try {
                    $split = explode("/", $image->url);

                    $file = Storage::disk('platforms')->readStream($image->url);
                    $zip->addFileFromStream($split[1], $file);                    

                }
                catch (Exception $e) {
                    Log::error("unable to read the file at storage path: $image->url and output to zip stream. Exception is " . $e->getMessage());
                }

            }

            $zip->finish();
        }, $this->platform->slug.'.zip');
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
