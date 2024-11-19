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
        'name' => $platform->name,
        'route' => route('admin.platforms.edit',$platform),
    ],
    [
        'name' => 'Imagenes'
    ]
]">

    @livewire('admin.platforms.platform-image', ['platform' => $platform])

    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/basicLightbox/5.0.0/basicLightbox.min.css" integrity="sha512-C+KPK958JmUdU8B9SVr8YpEZtQ1T1XrFX/OLvE/lt336DFWXFHL5Y9/tUewMEU+Uy3dUAS363XXLdBine0WDyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush
    
    @push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/basicLightbox/5.0.0/basicLightbox.min.js" integrity="sha512-jIc3kBeyfyLXBTmzUIXnbGiVK2wgWGcDIkJwkFW4bQ6v2h/piOKLwIfy3wOmKHWIu8DgYSKVth0DMUvExMYcOw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function preview(url){

            basicLightbox.create(`
		    <img src="`+url+`">`).show()
        }
    </script>
    
    @endpush
</x-admin-layout>