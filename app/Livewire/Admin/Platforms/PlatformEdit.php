<?php

namespace App\Livewire\Admin\Platforms;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class PlatformEdit extends Component
{
    use WithFileUploads;

    public $platform;

    public $name = "";
    public $slug = "";
    public $title = "";
    public $text = "";
    public $verificationCode = "";
    public $qtyPhotos = 0;
    public $qtyUsers = 0;
    public $background;
    public $background2;
    public $icon;
    public $qr;
    public $loadLogo;
    public $loadBackground;
    public $userDocument = "";
    public $status;

    public $urlLoadBackground;
    public $urlLoadLogo;
    public $urlBackground;
    public $urlIcon;
    public $urlBackground2;
    public $urlQr;

    public function mount(){
        $this->urlLoadBackground = $this->platform->load_background;
        $this->urlLoadLogo = $this->platform->load_logo;
        $this->urlBackground = $this->platform->background;
        $this->urlIcon = $this->platform->icon;
        $this->urlBackground2 = $this->platform->background2;
        $this->urlQr= $this->platform->qr;
        $this->name = $this->platform->name;
        $this->slug = $this->platform->slug;
        $this->title = $this->platform->title;
        $this->verificationCode = $this->platform->verification_code;
        $this->text = $this->platform->text;
        $this->qtyPhotos = $this->platform->qty_photos;
        $this->qtyUsers = $this->platform->qty_users;
        $this->userDocument = $this->platform->user->document;
        $this->status = $this->platform->status;
    }

    public function generateCode(){

        $this->verificationCode = Str::random(10);

    }

    public function save(){

        $this->validate([
            'loadLogo' => 'nullable|max:3072',
            'loadBackground' => 'nullable|max:3072',
            'background' => 'nullable|max:3072',
            'icon' => 'nullable|max:3072',
            'background2' => 'nullable|max:3072',
            'name' => 'required',
            'slug' => 'required|unique:platforms,slug,'.$this->platform->id,
            'title' => 'required',
            'text' => 'required',
            'verificationCode' => 'required',
            'qtyPhotos' => 'required|numeric',
            'qtyUsers' => 'required|numeric',
            'userDocument' => 'required|exists:users,document',
            'status' => 'required|boolean'
        ]);

        if ($this->background) {

            Storage::delete($this->platform->background);
            $this->urlBackground = $this->background->store('platforms');
        }

        if ($this->background2) {

            Storage::delete($this->platform->background2);
            $this->urlBackground2 = $this->background2->store('platforms');
        }

        if ($this->icon) {

            Storage::delete($this->platform->icon);
            $this->urlIcon = $this->icon->store('platforms');
        }

        if ($this->qr) {

            if ($this->urlQr) {
                Storage::delete($this->urlQr);
            }
            $this->urlQr = $this->qr->store('platforms');
        }

        if ($this->loadLogo) {

            Storage::delete($this->platform->load_logo);
            $this->urlLoadLogo = $this->loadLogo->store('platforms');
        }
        if ($this->loadBackground) {

            Storage::delete($this->platform->load_background);
            $this->urlLoadBackground = $this->loadBackground->store('platforms');
        }

        $user = User::where('document', $this->userDocument)->first();

        $this->platform->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'title' => $this->title,
            'text' => $this->text,
            'qty_photos' => $this->qtyPhotos,
            'qty_users' => $this->qtyUsers,
            'load_background' => $this->urlLoadBackground,
            'verification_code' => $this->verificationCode,
            'load_logo' => $this->urlLoadLogo,
            'background' => $this->urlBackground,
            'icon' => $this->urlIcon,
            'background2' => $this->urlBackground2,
            'qr' => $this->urlQr,
            'status' => $this->status,
            'user_id' => $user->id
        ]);

        return redirect()->route('admin.platforms.edit', $this->platform)->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Plataforma actualizada correctamente.'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.platforms.platform-edit');
    }
}
