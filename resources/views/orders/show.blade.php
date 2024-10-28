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
                <li>
                    <div class="flex items-center">
                      <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                      </svg>
                      <a href="{{route('orders.index')}}" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Mis Ordenes</a>
                    </div>
                  </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Orden</span>
                    </div>
                </li>
            </ol>
        </nav>

    </x-container>

    <x-container>
        <section class="bg-white py-8 antialiased dark:bg-gray-900 ">
            <form action="#" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
              <div class="mx-auto max-w-3xl">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Resumen de Pedido</h2>
                <hr class="mt-3">
          
                <div class="mt-6 sm:mt-8">
                  <div class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-800">
                    <table class="w-full text-left font-medium text-gray-900 dark:text-white md:table-fixed">
                      <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                        @foreach ($order->content as $item)
                            
                            <tr>
                            <td class="whitespace-nowrap py-4 md:w-[384px]">
                                <div class="flex items-center gap-4">
                                <div class="flex items-center aspect-square w-10 h-10 shrink-0">
                                    <img class="h-auto w-full max-h-full aspect-square object-cover object-center" src="{{$item['options']['image']}}" />
                                </div>
                                <a href="{{route('products.show', $item['id'])}}" class="hover:underline">{{$item['name']}}</a>
                                </div>
                            </td>
            
                            <td class="p-4 text-base font-normal text-gray-900 dark:text-white">x{{$item['qty']}}</td>
            
                            <td class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">S/ {{number_format($item['price'],2)}}</td>
                            </tr>
                        @endforeach
          
                      </tbody>
                    </table>
                  </div>
          
                  <div class="mt-4 space-y-6">
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Resumen de Pago</h4>
          
                    <div class="space-y-4">
                      <div class="space-y-2">
                        <dl class="flex items-center justify-between gap-4">
                          <dt class="text-gray-500 dark:text-gray-400">Sub total</dt>
                          <dd class="text-base font-medium text-gray-900 dark:text-white">S/ {{number_format(($order->total + $order->discount)-$order->tax,2)}}</dd>
                        </dl>
                        @if ($order->discount > 0.00)
                            
                          <dl class="flex items-center justify-between gap-4">
                            <dt class="text-gray-500 dark:text-gray-400">Descuento</dt>
                            <dd class="text-base font-medium text-green-500">-S/ {{number_format($order->discount,2)}}</dd>
                          </dl>
                        @endif
          
                        <dl class="flex items-center justify-between gap-4">
                          <dt class="text-gray-500 dark:text-gray-400">I.G.V</dt>
                          <dd class="text-base font-medium text-gray-900 dark:text-white">S/ {{number_format($order->tax,2)}}</dd>
                        </dl>
                      </div>
          
                      <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                        <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                        <dd class="text-lg font-bold text-gray-900 dark:text-white">S/ {{number_format($order->total,2)}}</dd>
                      </dl>
                    </div>
          
                  </div>
                </div>
              </div>
            </form>
          </section>
          
          
    </x-container>

    
</x-app-layout>