<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Invitaciones',
    ],
]">

@livewire('admin.invitations.invitation-index')


</x-admin-layout>