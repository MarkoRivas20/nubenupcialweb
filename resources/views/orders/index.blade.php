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
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Mis ordenes</span>
                    </div>
                </li>
            </ol>
        </nav>

    </x-container>

    <x-container>
        
        <div class="card">
            <h2 class="mb-4 text-xl font-semibold text-gray-600">Mis pedidos</h2>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Fecha de Orden
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Método de Pago
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Estado
                            </th>
                            <th scope="col" class="px-6 py-3">
    
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{$order->created_at->format('d/m/Y')}}
                                </td>
                                <td class="px-6 py-4">
                                    S/ {{number_format($order->total,2)}}
                                </td>
                                <td class="px-6 py-4">
                                    @switch($order->payment_method)
                                        @case(1)
                                            Yape o Plin
                                            @break
                                        @case(2)
                                            T. Crédito o Débito
                                            @break
                                        @default
                                            
                                    @endswitch
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order->status->name }}
                                </td>

                                <td>
                                    <a href="{{route('orders.show', $order)}}" class="underline text-blue-500 hover:no-underline cursor-pointer">
                                        Ver Detalle
                                    </a>
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
                    {{ $orders->links() }}
            </div>
        </div>
    </x-container>
</x-app-layout>