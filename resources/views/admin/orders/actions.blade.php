<div class="flex flex-col space-y-2">
    <button wire:click="showOrder({{$order->id}})" class="underline text-blue-500 hover:no-underline">
        Ver Pedido
    </button>
    
    @switch($order->status)
        @case(\App\Enums\OrderStatus::Pending)
            <button wire:click="markAsProcessing({{$order->id}})" class="underline text-blue-500 hover:no-underline">
                Listo para procesar
            </button>
            @break
        @case(\App\Enums\OrderStatus::Processing)
            <button wire:click="markAsCompleted({{$order->id}})" class="underline text-blue-500 hover:no-underline">
                Marcar como completado
            </button>
            @break
        @case (\App\Enums\OrderStatus::Cancelled)
            <button wire:click="markAsRefunded({{$order->id}})" class="underline text-blue-500 hover:no-underline">
                Devolver dinero
            </button>
        
        @default
            
    @endswitch

    @if (($order->status != \App\Enums\OrderStatus::Cancelled) && ($order->status != \App\Enums\OrderStatus::Refunded))
        <button wire:click="cancelOrder({{$order->id}})" class="underline text-blue-500 hover:no-underline">
            Cancelar
        </button>
    @endif

    
</div>