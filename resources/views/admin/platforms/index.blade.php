<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Plataformas',
    ],
]">

<x-slot name="action">
    <a class="btn btn-blue" href="{{route('admin.platforms.create')}}">Nuevo</a>
</x-slot>

@if ($platforms->count())
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Estado
                            </th>
                            <th scope="col" class="px-6 py-3">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($platforms as $platform)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$platform->id}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$platform->name}}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($platform->status)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Activo</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Inactivo</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex space-x-2">
                                    
                                    <a href="{{route('admin.platforms.edit', $platform)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                    <a href="{{route('admin.platforms.images', $platform)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver Fotos</a>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{$platforms->links()}}
            </div>
    
        @else
            <div class="p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                <span class="font-medium">Alerta!</span> Todavia no hay plataformas registradas.
            </div>
        @endif

</x-admin-layout>