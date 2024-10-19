<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Invitationes',
        'route' => route('admin.invitations.index'),
    ],
    [
        'name' => 'Nuevo'
    ]
]">

@livewire('admin.invitations.invitation-create', ['template' => $template])

</x-admin-layout>