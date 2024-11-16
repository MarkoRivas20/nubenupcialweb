<x-app-layout>
    <x-container class="px-4 my-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{route('store.index')}}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Inicio
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Mis plataformas</span>
                    </div>
                </li>
            </ol>
        </nav>

    </x-container>

    <x-container>
        
        <div class="card">
            <h2 class="mb-4 text-xl font-semibold text-gray-600">Mis plataformas</h2>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Plataforma
                            </th>
                            <th scope="col" class="px-6 py-3">
    
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($platforms as $platform)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">

                                <td class="px-6 py-4 flex items-center">
                                    <img src="{{Storage::url($platform->load_logo)}}" class="w-12 aspect-square object-cover object-center mr-6">
                                    <span>
                                        {{ $platform->name }}
                                    </span>
                                </td>
                                <td class="space-x-4">
                                    <div class="flex flex-col md:flex-row justify-end px-6 text-center gap-2 md:gap-4 text-xs">

                                        @if ($platform->qr)
                                            
                                            <a href="{{route('platforms.download', $platform)}}" class="underline text-blue-500 hover:no-underline cursor-pointer">
                                                Descargar QR
                                            </a>
                                        @endif

                                        @if ($platform->status)
                                            
                                            <a href="{{route('platforms.show', [$platform, $platform->verification_code])}}" class="underline text-blue-500 hover:no-underline cursor-pointer">
                                                Ver Plataforma
                                            </a>
                                        @endif
                                        
                                        <a  class="underline text-blue-500 hover:no-underline cursor-pointer">
                                            Ver Imagenes
                                        </a>
                                        

                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        No existen registros
                                    </td>
                                </tr>
                            @endforelse
    
                        </tbody>
                </table>
            </div>
    
            <div class="mt-4">
                    {{ $platforms->links() }}
            </div>
        </div>
    </x-container>
</x-app-layout>