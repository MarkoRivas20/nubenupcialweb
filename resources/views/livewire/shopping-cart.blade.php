<div>
    <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
        <div class="lg:col-span-5">
            <div class="flex justify-between mb-2">
                <h1 class="text-xl">
                    Carrito de compras ({{Cart::count()}} productos)
                </h1>

                <button wire:click="destroy()" class="font-semibold text-gray-600 hover:text-red-400 underline hover:no-underline">
                    Limpiar carro
                </button>
            </div>

            <div class="card">
                <ul class="space-y-4">
                    @forelse (Cart::content() as $item)
                        <li class="lg:flex lg:items-center {{($item->qty > $item->options['stock'] || $item->options['status'] == false) ? 'text-red-500' : ''}}">
                            <img src="{{$item->options->image}}" class="w-full lg:w-24 aspect-[4/3] object-cover object-center">
                            <div class="w-80 lg:ml-2">

                                @if ($item->qty > $item->options['stock'])
                                    <p class="font-semibold">
                                        Stock insuficiente
                                    </p>
                                @endif

                                @if ($item->options['status'] == false)
                                    <p class="font-semibold">
                                        No disponible
                                    </p>
                                @endif

                                <p class="text-sm truncate">
                                    <a href="{{route('products.show', $item->id)}}">
                                        {{$item->name}}
                                    </a>
                                </p>
                                @if ($item->options['features'])
                                    <p class="text-xs mb-2">
                                        @php
                                            $features = '';
                                            foreach ($item->options['features'] as $feature) {
                                                $features = $features. ' | '. $feature;
                                            }
                                        @endphp
                                        {{substr($features,2)}}
                                    </p>
                                @endif

                                <button wire:click="remove('{{$item->rowId}}')" class="bg-red-100 hover:bg-red-200 text-red-800 text-xs font-semibold rounded px-2.5 py-0.5">
                                    <i class="fa-solid fa-xmark"></i>
                                    Quitar
                                </button>
                            </div>
                            <p>
                                S/ {{number_format($item->price,2)}}
                            </p>
                            <div class="ml-auto space-x-3">
                                <button class="btn btn-blue" 
                                wire:click="decrease('{{$item->rowId}}')"
                                wire:loading.attr="disabled".
                                wire:target="decrease('{{$item->rowId}}')">
                                    -
                                </button>
                                <span class="inline-block w-2 text-center">
                                    {{$item->qty}}
                                </span>
                                <button class="btn btn-blue" 
                                wire:click="increase('{{$item->rowId}}')"
                                wire:loading.attr="disabled".
                                wire:target="increase('{{$item->rowId}}')"
                                @disabled($item->qty >= $item->options['stock'])>
                                    +
                                </button>
                            </div>
                        </li>
                    @empty
                        <p class="text-center">
                            No hay productos en el carrito
                        </p>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="card">
                <div class="flex justify-between font-semibold mb-2">
                    <p>
                        Sub Total:
                    </p>

                    <p>
                        S/ {{number_format($this->subtotal,2)}}
                    </p>
                </div>

                {{-- <div class="flex justify-between font-semibold mb-2">
                    <p>
                        I.G.V: <span class="text-xs font-normal">({{$this->configuration->content['tax']}} %)</span>
                    </p>

                    <p>
                        S/ {{number_format($this->tax,2)}}
                    </p>
                </div> --}}

                <div class="flex justify-between font-semibold mb-2">
                    <p>
                        Total: <span class="text-xs text-gray-500">(incluye I.G.V.)</span>
                    </p>

                    <p>
                        S/ {{number_format($this->subtotal,2)}}
                    </p>
                </div>

                
                @if (Cart::count())
                    <a href="{{route('checkout.index')}}" class="btn btn-blue block w-full text-center">
                        Continuar compra
                    </a>
                @else
                    <button class="btn btn-blue block w-full text-center" disabled>
                        Continuar compra
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
