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
        'name' => $platform->name
    ]
]">

@livewire('admin.platforms.platform-edit', ['platform' => $platform])

</x-admin-layout>