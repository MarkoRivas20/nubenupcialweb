<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Plantillas',
        'route' => route('admin.templates.index'),
    ],
    [
        'name' => $template->name,
        'route' => route('admin.templates.edit', $template),
    ],
    [
        'name' => 'Nuevo',
    ],
]">

<div class="card">
        <x-validation-errors class="mb-4" />

        <form action="{{route('admin.sections.store', $template)}}" method="POST">
            @csrf

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la Sección" name="name" value="{{old('name')}}"/>
            </div>
    
            <div class="mb-4">
                <x-label class="mb-1">Descripción</x-label>
                <textarea rows="15" name="body" id="body" class="w-full">{{old('body')}}</textarea>
            </div>

            <div class="flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>

    </div>

</x-admin-layout>
