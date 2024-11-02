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
        'name' => $invitation->name
    ]
]">

@livewire('admin.invitations.invitation-edit', ['invitation' => $invitation])

</x-admin-layout>