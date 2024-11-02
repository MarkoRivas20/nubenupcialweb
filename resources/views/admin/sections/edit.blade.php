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
        'name' => $section->name,
    ],
]">

<div class="card mb-12">
        <x-validation-errors class="mb-4" />

        <form action="{{route('admin.sections.update', [$template,$section])}}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la Sección" name="name" value="{{ old('name', $section->name) }}"/>
            </div>
    
            <div class="mb-4">
                <x-label class="mb-1">Descripción</x-label>
                <textarea rows="15" name="body" id="body" class="w-full">{{old('body',$section->body)}}</textarea>
            </div>

            <div class="flex justify-end">
                <div class="flex justify-end gap-2">

                    <x-danger-button onclick="confirmDelete()">Eliminar</x-danger-button>
    
                    <x-button>Actualizar</x-button>
                </div>
            </div>
        </form>

        <form action="{{ route('admin.sections.destroy', [$template,$section]) }}" method="POST" id="delete-form">
            @csrf
            @method('DELETE')
        </form>

    </div>

    @livewire('admin.sections.section-attributes', ['section' => $section])

    @push('js')
        <script>

            function confirmDelete() {
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡No podrás revertir esto",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, ¡bórralo!",
                    cancelButtonText:"Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
    @endpush

</x-admin-layout>
