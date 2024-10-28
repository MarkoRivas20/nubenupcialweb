<div class="mb-2">
    <div class="flex space-x-3">
        <x-input wire:model="code" class="flex-1 mb-2" placeholder="Ingrese el cupón de descuento"/>
        <button wire:click="validateCoupon()" class="btn btn-blue flex-shrink-0">
            Usar Cupón
        </button>
    </div>
    @if ($showError)
        
        <span class="text-sm text-red-500 -mt-2">* Código no disponible</span>
    @endif
</div>