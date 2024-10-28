<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Configuración',
    ]
]">

@livewire('admin.configurations.configuration-edit',['configuration' => $configuration])

</x-admin-layout>