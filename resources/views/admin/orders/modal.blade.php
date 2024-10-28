<x-dialog-modal wire:model="openModalOrder">
    <x-slot name="title">
        Detalle de la compra
    </x-slot>

    <x-slot name="content">
        @if ($order)

            @if ($coupon['discount'] > 0.00)
                <div class="flex justify-between uppercase mb-2">
                    <p>
                        <b>CUPÓN:</b> {{$coupon['promo_code']}}
                    </p>
                    <p>
                        <b>S/  {{$coupon['discount']}}</b>
                    </p>
                </div>
                <hr class="mb-2">
            @endif

            <div class="space-y-2">
                @foreach ($order as $item)
                <div>
                    <p><span class="font-semibold">Nombre:</span> {{$item['name']}}</p>
                    <p><span class="font-semibold">Cantidad:</span> {{$item['qty']}}</p>
                    <p><span class="font-semibold">Precio:</span> S/ {{$item['price']}}</p>
                    @if ($item['options']['features'])
                        <p><span class="font-semibold">Opciones:</span></p>
                            <ul>
                                @foreach ($item['options']['features'] as $feature)
                                    <li>
                                        {{$feature}}
                                    </li>
                                @endforeach
                            </ul>
                    @endif
                </div>
                <hr>
                @endforeach
            </div>
            
        @endif
       
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="$set('openModalOrder', false)">
            Cerrar
        </x-danger-button>
    </x-slot>
</x-dialog-modal>