
    <x-container>
        <div class="card">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <figure>
                        <img src="{{$product->image}}" class="aspect-[1/1] w-full object-cover object-center">
                    </figure>
                    
                </div>
                <div class="col-span-1">
                    <h1 class="text-xl text-gray-600 mb-3">
                        {{$product->name}}
                    </h1>
                    <p class="font-semibold text-2xl text-gray-600 mb-4">
                        S/ {{$product->price}}
                    </p>

                    <div class="flex items-center space-x-6 mb-6" x-data="{
                        qty: @entangle('qty')
                    }">
                        <button class="btn btn-blue" x-on:click="qty = qty - 1" x-bind:disabled="qty <= 1">
                            -
                        </button>
                        <span x-text="qty" class="inline-block w-2 text-center"></span>
                        <button class="btn btn-blue" x-on:click="qty = qty + 1">
                            +
                        </button>
                    </div>

                    <button class="btn btn-blue w-full mb-6" wire:click="add_to_cart" wire:loading.attr="disabled">
                        Agregar al carrito
                    </button>

                    <div>
                        {!!$product->description!!}
                    </div>
                </div>
            </div>
        </div>
    </x-container>

