<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    public $search;

    public function updatingSearch(){

        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('id', '<>', auth()->id())
        ->where(function ($query){
            $query->where('name', 'LIKE', '%'.$this->search.'%');
            $query->orWhere('last_name', 'LIKE', '%'.$this->search.'%');
            $query->orWhere('email', 'LIKE', '%'.$this->search.'%');
            $query->orWhere('document', 'LIKE', '%'.$this->search.'%');
        })
        
        ->paginate();

        return view('livewire.admin.users.user-index', compact('users'));
    }
}
