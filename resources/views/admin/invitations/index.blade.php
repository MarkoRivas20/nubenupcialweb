<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Invitaciones',
    ],
]">

<div>
    {{$body}}

</div>

</x-admin-layout>