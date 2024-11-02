<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Recursos',
        'route' => route('admin.resources.index'),
    ],
    [
        'name' => $resource->name
    ]
]">


@livewire('admin.resources.resource-edit', ['resource'=> $resource])

</x-admin-layout>