<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorias',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => 'Nuevo'
    ]
]">  

    <div class="card">

        <x-validation-errors class="mb-4"/>

        <form action="{{route('admin.categories.store')}}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la Categoria" name="name" value="{{old('name')}}"/>
            </div>

            <div class="flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
