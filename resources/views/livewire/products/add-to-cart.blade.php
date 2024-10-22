<div x-data="{
    qty: @entangle('qty'),
    stock: @entangle('stock')
}">
    <h1 class="text-xl text-gray-600 mb-3">
        {{ $product->name }} <span x-show="stock == 0" class="text-xs text-red-500 font-semibold">(Producto agotado)</span>
    </h1>

    <p class="font-semibold text-2xl text-gray-600 mb-4">
        S/ {{ $product->price }}
    </p>

    <div class="flex items-center space-x-6 mb-6" >
        <button class="btn btn-blue" x-on:click="qty = qty - 1" x-bind:disabled="qty <= 1">
            -
        </button>
        <span x-text="qty" class="inline-block w-2 text-center"></span>
        <button class="btn btn-blue" x-on:click="qty = qty + 1" :disabled="qty >= stock">
            +
        </button>
    </div>

    <div class="flex flex-col">
        @foreach ($product->options as $option)
            <div class="mr-4 mb-4">
                <p class="font-semibold text-lg mb-2">
                    {{ $option->name }}
                </p>

                <ul class="flex flex-wrap space-x-2">
                    @foreach ($option->pivot->features as $feature)
                        <li>
                            @switch($option->type)
                                @case(1)
                                    <button wire:click="$set('selectedFeatures.{{ $option->id }}', {{ $feature['id'] }})"
                                        class="w-20 h-8 font-semibold uppercase text-sm rounded-lg {{ $selectedFeatures[$option->id] == $feature['id'] ? 'bg-blue-600 text-white' : ' border border-gray-200 text-gray-700' }}">
                                        {{ $feature['value'] }}
                                    </button>
                                @break

                                @case(2)
                                    <div
                                        class="p-0.5 border-2 rounded-lg flex items-center -mt-1.5 {{ $selectedFeatures[$option->id] == $feature['id'] ? 'border-blue-600' : 'border-transparent' }}">
                                        <button wire:click="$set('selectedFeatures.{{ $option->id }}', {{ $feature['id'] }})"
                                            class="w-20 h-8 rounded-lg border border-gray-200"
                                            style="background-color: {{ $feature['value'] }}"></button>
                                    </div>
                                @break

                                @default
                            @endswitch
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <button class="btn btn-blue w-full mb-6" wire:click="add_to_cart" wire:loading.attr="disabled" :disabled="stock == 0">
        Agregar al carrito
    </button>

    <div>
        {!! $product->description !!}
    </div>
</div>
