<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
        'route' => route('admin.covers.index'),
    ],
    [
        'name' => $cover->title
    ]
]">  

<form action="{{route('admin.covers.update',$cover)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <figure class="relative mb-4">

        <div class="absolute top-8 right-8">
            <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                <i class="fas fa-camera mr-2"></i>
                Actualizar imagen

                <input type="file" 
                accept="image/*"
                class="hidden"
                name="image"
                onchange="previewImage(event, '#imgPreview')">
            </label>
        </div>

        <img id="imgPreview" src="{{$cover->image}}" alt="Portada" class="aspect-[3/1] w-full object-cover object-center">
    </figure>

    <x-validation-errors class="mb-4"/>

    <div class="mb-4">
        <x-label>
            Título
        </x-label>
        <x-input name="title" value="{{old('title', $cover->title)}}" class="w-full" placeholder="Por favor ingrese el título de la portada"/>
    </div>

    <div class="mb-4">
        <x-label>
            Fecha de inicio
        </x-label>
        <x-input type="date" name="start_at" value="{{old('start_at', $cover->start_at->format('Y-m-d'))}}" class="w-full" />
    </div>

    <div class="mb-4">
        <x-label>
            Fecha fin (opcional)
        </x-label>
        <x-input type="date" name="end_at" value="{{old('end_at', $cover->end_at ? $cover->end_at->format('Y-m-d') : '')}}" class="w-full" />
    </div>

    <div class="mb-4 flex space-x-2">
        <label>
            <x-input type="radio" name="status" value="1" :checked="$cover->status == 1"/>
            Activo
        </label>

        <label>
            <x-input type="radio" name="status" value="0" :checked="$cover->status == 0"/>
            Inactivo
        </label>
    </div>

    <div class="flex justify-end">
        <x-button>
            Actualizar
        </x-button>
    </div>

</form>

@push('js')
    <script>
        function previewImage(event, querySelector){

            //Recuperamos el input que desencadeno la acción
            const input = event.target;

            //Recuperamos la etiqueta img donde cargaremos la imagen
            $imgPreview = document.querySelector(querySelector);

            // Verificamos si existe una imagen seleccionada
            if(!input.files.length) return

            //Recuperamos el archivo subido
            file = input.files[0];

            //Creamos la url
            objectURL = URL.createObjectURL(file);

            //Modificamos el atributo src de la etiqueta img
            $imgPreview.src = objectURL;
                    
        }
    </script>
@endpush


</x-admin-layout>