<?php

namespace App\Livewire\Admin\Platforms;

use App\Models\Platform;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class PlatformCreate extends Component
{

    use WithFileUploads;

    public $name = "";
    public $slug = "";
    public $title = "";
    public $text = "";
    public $verificationCode = "";
    public $qtyPhotos = 0;
    public $qtyUsers = 0;
    public $background;
    public $loadLogo;
    public $loadBackground;
    public $userDocument = "";

    public function generateCode(){

        $this->verificationCode = Str::random(10);

    }

    public function save(){

        $this->validate([
            'loadLogo' => 'required|max:3072',
            'loadBackground' => 'required|max:3072',
            'background' => 'required|max:3072',
            'name' => 'required',
            'slug' => 'required|unique:platforms,slug',
            'title' => 'required',
            'text' => 'required',
            'qtyPhotos' => 'required|numeric',
            'qtyUsers' => 'required|numeric',
            'userDocument' => 'required|exists:users,document',
        ]);

        $urlBackground= $this->background->store('platforms');
        $urlLoadLogo = $this->loadLogo->store('platforms');
        $urlLoadBackground = $this->loadBackground->store('platforms');

        $user = User::where('document', $this->userDocument)->first();

        $platform = Platform::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'title' => $this->title,
            'text' => $this->text,
            'qty_photos' => $this->qtyPhotos,
            'qty_users' => $this->qtyUsers,
            'load_background' => $urlLoadBackground,
            'load_logo' => $urlLoadLogo,
            'background' => $urlBackground,
            'verification_code' => $this->verificationCode,
            'status' => false,
            'user_id' => $user->id
        ]);

        return redirect()->route('admin.platforms.edit', $platform)->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Plataforma creada correctamente.'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.platforms.platform-create');
    }
}
