<div class="card">
    <div class="mb-4">
        <x-label class="mb-1">I.G.V.</x-label>
        <x-input type="number" step="0.01" wire:model="configurationEdit.tax" class="w-full" placeholder="Por favor, introduzca el U.G.V."/>
    </div>

    <div class="mb-4">
        <x-label class="mb-1">Método de pago</x-label>
        <x-select class="w-full" wire:model="configurationEdit.paymentMethod">
            <option value="" disabled>Selecciona un método de pago</option>
            <option value="1" {{$configurationEdit['paymentMethod'] == 1 ? 'selected' : ''}}>Efectivo (Yape o Plin)</option>
            <option value="2" {{$configurationEdit['paymentMethod'] == 2 ? 'selected' : ''}}>Tarjetas y efectivo (Yape o Plin)</option>
        </x-select>
    </div>

    <div class="mb-4">
        <x-label class="mb-1">Uso de Cupónes</x-label>
        <x-select class="w-full" wire:model="configurationEdit.couponStatus">
            <option value="0" {{$configurationEdit['couponStatus'] == 0 ? 'selected' : ''}}>Deshabilitado</option>
            <option value="1" {{$configurationEdit['couponStatus'] == 1 ? 'selected' : ''}}>Habilitado</option>
        </x-select>
    </div>

    <div class="flex justify-end">
        <x-button wire:click="save()">Actualizar</x-button>
    </div>
</div>
