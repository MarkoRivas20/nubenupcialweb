<?php

namespace App\Livewire\Admin\Invitations;

use App\Models\Invitation;
use App\Models\InvitationAttribute;
use App\Models\InvitationSection;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class InvitationEdit extends Component
{
    use WithFileUploads;
    public $invitation;

    public $nameSection = "";
    public $openModal = false;
    public $image;
    public $logo;
    public $background;
    public $qr;

    public $invitationName = "";
    public $invitationSlug = "";
    public $invitationIcon = "";
    public $invitationLogo = "";
    public $invitationBackground = "";
    public $invitationQr = "";
    public $userDocument = "";
    public $invitationStatus = false;
    public $invitationSelected = [];

    public function mount(){
        $this->invitationName = $this->invitation->name;
        $this->invitationSlug = $this->invitation->slug;
        $this->invitationIcon = $this->invitation->icon;
        $this->invitationLogo = $this->invitation->load_logo;
        $this->invitationBackground = $this->invitation->load_background;
        $this->invitationQr = $this->invitation->qr;
        $this->invitationStatus = $this->invitation->status;

        $this->userDocument = $this->invitation->user->document;

        foreach ($this->invitation->sections()->orderBy('order','asc')->get() as $index=>$section) {
            
            $this->invitationSelected[] = [
                'id' => $section->id,
                'name' => $section->name,
                'body' => $section->body,
                'attributes' => []
            ];

            foreach ($section->attributes as $attribute) {
                $this->invitationSelected[$index]['attributes'][] = [
                    'id' => $attribute->id,
                    'type' => $attribute->type,
                    'key' => $attribute->key,
                    'value' => $attribute->value
                ];
            }
        }

    }

    public function addSection(){

        $this->invitationSelected[] = [
            'id' => '',
            'name' => $this->nameSection,
            'body' => '',
            'attributes' => []
        ];

        $this->openModal=false;

    }

    public function addAttribute($index){

        $this->invitationSelected[$index]['attributes'][] = [
            'id' => '',
            'type' => '',
            'key' => '',
            'value' => ''
        ];

    }

    public function removeSection($index){

        unset($this->invitationSelected[$index]);
        $this->invitationSelected = array_values($this->invitationSelected);
        
    }

    public function removeAttribute($indexSection, $indexAttribute){

        unset($this->invitationSelected[$indexSection]['attributes'][$indexAttribute]);
        $this->invitationSelected[$indexSection]['attributes'] = array_values($this->invitationSelected[$indexSection]['attributes']);
        
    }

    public function save(){

        $this->validate([
            'image' => 'nullable|max:1024',
            'logo' => 'nullable|max:3072',
            'background' => 'nullable|max:3072',
            'qr' => 'nullable|max:3072',
            'invitationName' => 'required',
            'invitationSlug' => 'required|unique:invitations,slug,'.$this->invitation->id,
            'invitationStatus' => 'required|boolean',
            'userDocument' => 'required|exists:users,document',
            'invitationSelected.*.name' => 'required',
            'invitationSelected.*.body' => 'required',
            'invitationSelected.*.attributes.*.type' => 'required|in:1,2,3',
            'invitationSelected.*.attributes.*.key' => 'required',
            'invitationSelected.*.attributes.*.value' => 'required',
        ]);


        if ($this->image) {

            Storage::delete($this->invitationIcon);
            $this->invitationIcon = $this->image->store('invitations');
        }

        if ($this->logo) {

            Storage::delete($this->invitationLogo);
            $this->invitationLogo = $this->logo->store('invitations');
        }

        if ($this->background) {

            Storage::delete($this->invitationBackground);
            $this->invitationBackground = $this->background->store('invitations');
        }

        if ($this->qr) {

            if ($this->invitationQr) {
                Storage::delete($this->invitationQr);
            }
            $this->invitationQr = $this->qr->store('invitations');
        }

        $user = User::where('document', $this->userDocument)->first();

        $this->invitation->update([
            'name' => $this->invitationName,
            'slug' => $this->invitationSlug,
            'icon' => $this->invitationIcon,
            'load_logo' => $this->invitationLogo,
            'load_background' => $this->invitationBackground,
            'qr' => $this->invitationQr,
            'status' => $this->invitationStatus,
            'user_id' => $user->id
        ]);

        foreach ($this->invitationSelected as $key => $section) {

            $newSectionId = 0;

            if($section['id']){
                InvitationSection::find($section['id'])->update([
                    'name' => $section['name'],
                    'body' => $section['body'],
                    'order' => $key
                ]);
                $newSectionId = $section['id'];
            }else{
                $newSection = InvitationSection::create([
                    'name' => $section['name'],
                    'body' => $section['body'],
                    'order' => $key,
                    'invitation_id' => $this->invitation->id
                ]);

                $newSectionId = $newSection->id;
            }

            foreach ($section['attributes'] as $key => $attribute) {

                if($attribute['id']){
                    InvitationAttribute::find($attribute['id'])->update([
                        'type' => $attribute['type'],
                        'key' => $attribute['key'],
                        'value' => $attribute['value'],
                    ]);
                }else{
                    InvitationAttribute::create([
                        'type' => $attribute['type'],
                        'key' => $attribute['key'],
                        'value' => $attribute['value'],
                        'invitation_section_id' => $newSectionId
                    ]);
                }

                
            }
        }

        return redirect()->route('admin.invitations.edit', $this->invitation)->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Invitación actualizada correctamente.'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.invitations.invitation-edit');
    }
}
