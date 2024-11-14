<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Plataformas',
        'route' => route('admin.platforms.index'),
    ],
    [
        'name' => 'Nuevo'
    ]
]">

@livewire('admin.platforms.platform-create')

</x-admin-layout>