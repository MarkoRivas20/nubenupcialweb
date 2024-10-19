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
    ],
]">

    <div class="card">

        <x-validation-errors class="mb-4"/>

        <form action="{{ route('admin.templates.update', $template) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la Plantilla" name="name"
                    value="{{ old('name', $template->name) }}" />
            </div>

            <div class="flex justify-end gap-2">

                <x-danger-button onclick="confirmDelete()">Eliminar</x-danger-button>

                <x-button>Actualizar</x-button>
            </div>
        </form>

        <form action="{{ route('admin.templates.disabled', $template) }}" method="POST" id="delete-form">
            @csrf
            @method('PUT')
            
        </form>
    </div>

    <section class="rounded-lg border border-gray-100 bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">Secciones</h1>
                <a href="{{route('admin.sections.create', $template)}}" class="btn btn-blue">
                    Nuevo
                </a>
            </div>
        </header>
        <div class="p-6">
            <ul class="space-y-4" id="covers">
                @foreach ($template->sections as $section)
                    <li class="lg:flex overflow-hidden bg-white rounded-lg drop-shadow-lg">
                         <div class="p-4 lg:flex-1 lg:flex lg:justify-between lg:items-center space-y-3 lg:space-y-0">
                             <div>
                                 <h1 class="font-semibold">
                                     {{$section->name}}
                                 </h1>
                             </div>
                             <div>
                                 <a class="btn btn-blue" href="{{route('admin.sections.edit', [$template,$section])}}">
                                     Editar
                                 </a>
                             </div>
                         </div>
                    </li>
                @endforeach 
             </ul>
        </div>
    </section>


</x-admin-layout>
