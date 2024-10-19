<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
    ],
]">  

<x-slot name="action">
    <a href="{{route('admin.covers.create')}}" class="btn btn-blue">
        Nuevo
    </a>
</x-slot>

<ul class="space-y-4" id="covers">
    @if ($covers->count())
    @foreach ($covers as $cover)
    <li data-id="{{$cover->id}}" class="lg:flex overflow-hidden bg-white rounded-lg drop-shadow-lg cursor-move">
         <img src="{{$cover->image}}" class="w-full lg:w-64 aspect-[3/1] object-cover object-center">
         <div class="p-4 lg:flex-1 lg:flex lg:justify-between lg:items-center space-y-3 lg:space-y-0">
             <div>
                 <h1 class="font-semibold">
                     {{$cover->title}}
                 </h1>
                 <p>
                     @if ($cover->status)
                         <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Activo</span>
                     @else
                         <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Inactivo</span>
                     @endif
                 </p>
             </div>
             <div>
                 <p class="text-sm font-bold">
                     Fecha de inicio
                 </p>
                 <p>
                     {{$cover->start_at->format('d/m/Y')}}
                 </p>
             </div>
             <div>
                 <p class="text-sm font-bold">
                     Fecha de finalización
                 </p>
                 <p>
                     {{$cover->end_at ? $cover->end_at->format('d/m/Y') : '-'}}
                 </p>
             </div>
             <div>
                 <a class="btn btn-blue" href="{{route('admin.covers.edit', $cover)}}">
                     Editar
                 </a>
             </div>
         </div>
    </li>
@endforeach 
    @else
        <div class="p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <span class="font-medium">Alerta!</span> Todavia no hay plantillas registradas.
        </div>
    @endif
   
</ul>


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.3/Sortable.min.js"></script>
    <script>
        new Sortable(covers, {
            animation: 150,
            ghostClass: 'bg-blue-100',
            store: {
                set: (sorteable) => {
                    const sorts = sorteable.toArray();

                    axios.post("{{route('api.sort.covers')}}", {
                        sorts: sorts
                    }).catch((error)=> {
                        console.log(error);
                    });
                }
            }
        });
    </script>
@endpush

</x-admin-layout>