<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Invitaciones',
        'route' => route('admin.invitations.index'),
    ],
    [
        'name' => $invitation->name,
        'route' => route('admin.invitations.edit', $invitation),
    ],
    [
        'name' => 'Imagenes',
    ]
]">

@livewire('admin.invitations.image.image-index', ['section' => $section])

</x-admin-layout>