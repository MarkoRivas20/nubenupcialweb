<?php

namespace App\Livewire\Platforms;

use App\Models\ImagePlatform;
use App\Models\PlatformUser;
use Livewire\Component;
use Livewire\WithPagination;

class PlatformDetail extends Component
{
    use WithPagination;

    public $platform;
    public $platformUsers;
    public $userIdSelected;

    public function mount(){
        $this->platformUsers = PlatformUser::where('platform_id', $this->platform->id)->get();

        $this->userIdSelected = $this->platformUsers->first()->user->id;
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
