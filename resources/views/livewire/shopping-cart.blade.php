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
                        <li class="lg:flex">
                            <img src="{{$item->options->image}}" class="w-full lg:w-24 aspect-[16/9] object-cover object-center">
                            <div class="w-80 lg:ml-2">
                                <p class="text-sm">
                                    <a href="{{route('products.show', $item->id)}}">
                                        {{$item->name}}
                                    </a>
                                </p>

                                <button wire:click="remove('{{$item->rowId}}')" class="bg-red-100 hover:bg-red-200 text-red-800 text-xs font-semibold rounded px-2.5 py-0.5">
                                    <i class="fa-solid fa-xmark"></i>
                                    Quitar
                                </button>
                            </div>
                            <p>
                                S/ {{$item->price}}
                            </p>
                            <div class="ml-auto space-x-3">
                                <button class="btn btn-blue" wire:click="decrease('{{$item->rowId}}')">
                                    -
                                </button>
                                <span class="inline-block w-2 text-center">
                                    {{$item->qty}}
                                </span>
                                <button class="btn btn-blue" wire:click="increase('{{$item->rowId}}')">
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
                        Total:
                    </p>

                    <p>
                        S/ {{Cart::subtotal()}}
                    </p>
                </div>

                <a href="" class="btn btn-blue block w-full text-center">
                    Continuar compra
                </a>
            </div>
        </div>
    </div>
</div>
