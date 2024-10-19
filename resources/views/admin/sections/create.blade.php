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
                <x-label class="mb-1">Tipo de Fondo</x-label>
    
                <x-select name="type_background" class="w-full">
                    <option value="" disabled>Seleccione un tipo de fondo</option>
                    <option value="1">Imagen</option>
                    <option value="2">Color</option>
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Fondo
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el valor del fondo" name="background" value="{{old('background')}}"/>
            </div>
    
            <div class="mb-4">
                <x-label class="mb-1">Descripción</x-label>
                <textarea name="body" id="body">{{old('body')}}</textarea>
            </div>

            <div class="flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>

    </div>

    @push('js')
        <script>
            ClassicEditor
                    .create(document.querySelector('#body'))
                    .catch(error => {
                        console.error('Error during initialization of the editor', error);
                    });
        </script>
    @endpush

</x-admin-layout>
