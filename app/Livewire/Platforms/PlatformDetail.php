<?php

namespace App\Livewire\Platforms;

use App\Models\ImagePlatform;
use App\Models\PlatformUser;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use ZipStream\ZipStream;

class PlatformDetail extends Component
{
    use WithPagination;

    public $platform;
    public $platformUsers;
    public $userIdSelected;

    public function mount(){
        $this->platformUsers = PlatformUser::where('platform_id', $this->platform->id)->where('user_id','!=', 1)->get();

        $this->userIdSelected = $this->platformUsers->first()->user->id;
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
                $query->where('platform_id', $platform->id)->where('user_id', $this->userIdSelected);
        })->paginate(10);

        return view('livewire.platforms.platform-detail', compact('images'));
    }
}
