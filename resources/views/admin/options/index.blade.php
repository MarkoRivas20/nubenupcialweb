<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Opciones',
    ],
]">  

@livewire('admin.options.manage-options')

</x-ax-admin-layout>