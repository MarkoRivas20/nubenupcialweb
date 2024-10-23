<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
        'route' => route('admin.users.index'),
    ],
    [
        'name' => $user->name . ' '.$user->last_name
    ]
]">  

<div class="card">

    <form action="{{route('admin.users.update',$user)}}" method="POST">
        @csrf
        @method('PUT')
    
        <x-validation-errors class="mb-4"/>
        <div class="mb-4 space-y-1">

            @php
                $userRole = $user->roles->first()->id;
            @endphp

            <x-label>
                Listado de Roles
            </x-label>
            <x-select class="w-full" name="roles">
                @foreach ($roles as $role)
                    
                    <option value="{{$role->id}}" {{$role->id == $userRole ? 'selected' : ''}}>{{$role->name}}</option>
                @endforeach
            </x-select>
        </div>
    
        <div class="flex justify-end">
            <x-button>
                Actualizar
            </x-button>
        </div>
    
    </form>
</div>


</x-admin-layout>
