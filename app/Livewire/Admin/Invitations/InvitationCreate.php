<?php

namespace App\Livewire\Admin\Invitations;

use App\Models\Invitation;
use App\Models\InvitationAttribute;
use App\Models\InvitationSection;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class InvitationCreate extends Component
{
    use WithFileUploads;

    public $nameSection = "";
    public $openModal = false;
    public $template;

    public $invitationName = "";
    public $invitationSlug = "";
    public $invitationIcon;
    public $invitationLogo;
    public $invitationBackground;
    public $userDocument = "";
    public $templateSelected = [];

    public function mount(){

        foreach ($this->template->sections as $index=>$section) {
            
            $this->templateSelected[] = [
                'name' => $section->name,
                'body' => $section->body,
                'attributes' => []
            ];

            foreach ($section->attributes as $attribute) {
                $this->templateSelected[$index]['attributes'][] = [
                    'type' => $attribute->type,
                    'key' => $attribute->key,
                    'value' => ''
                ];
            }
        }
    }

    public function addSection(){

        $this->templateSelected[] = [
            'name' => $this->nameSection,
            'body' => '',
            'attributes' => []
        ];

        $this->openModal=false;

    }

    public function addAttribute($index){

        $this->templateSelected[$index]['attributes'][] = [
            'type' => '',
            'key' => '',
            'value' => ''
        ];

    }

    public function removeSection($index){

        unset($this->templateSelected[$index]);
        $this->templateSelected = array_values($this->templateSelected);
        
    }

    public function removeAttribute($indexSection, $indexAttribute){

        unset($this->templateSelected[$indexSection]['attributes'][$indexAttribute]);
        $this->templateSelected[$indexSection]['attributes'] = array_values($this->templateSelected[$indexSection]['attributes']);
        
    }

    public function save(){

        $this->validate([
            'invitationIcon' => 'required|max:1024',
            'invitationLogo' => 'required|max:3072',
            'invitationBackground' => 'required|max:3072',
            'invitationName' => 'required',
            'invitationSlug' => 'required|unique:invitations,slug',
            'userDocument' => 'required|exists:users,document',
            'templateSelected.*.name' => 'required',
            'templateSelected.*.body' => 'required',
            'templateSelected.attributes.*.type' => 'required|in:1,2,3',
            'templateSelected.attributes.*.key' => 'required',
            'templateSelected.attributes.*.value' => 'required',
        ]);

        $urlIcon = $this->invitationIcon->store('invitations');
        $urlLogo = $this->invitationLogo->store('invitations');
        $urlBackground = $this->invitationBackground->store('invitations');

        $user = User::where('document', $this->userDocument)->first();

        $invitation = Invitation::create([
            'name' => $this->invitationName,
            'slug' => $this->invitationSlug,
            'icon' => $urlIcon,
            'load_background' => $urlBackground,
            'load_logo' => $urlLogo,
            'status' => false,
            'user_id' => $user->id
        ]);

        foreach ($this->templateSelected as $key => $section) {
            
            $newSection = InvitationSection::create([
                'name' => $section['name'],
                'body' => $section['body'],
                'order' => $key,
                'invitation_id' => $invitation->id
            ]);

            foreach ($section['attributes'] as $key => $attribute) {
                $newAttribute = InvitationAttribute::create([
                    'type' => $attribute['type'],
                    'key' => $attribute['key'],
                    'value' => $attribute['value'],
                    'invitation_section_id' => $newSection->id
                ]);
            }
        }

        return redirect()->route('admin.invitations.edit', $invitation)->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Invitación creada correctamente.'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.invitations.invitation-create');
    }
}
