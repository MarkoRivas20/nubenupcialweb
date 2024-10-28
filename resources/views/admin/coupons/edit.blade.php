<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Cupones',
        'route' => route('admin.coupons.index'),
    ],
    [
        'name' => $coupon->code,
    ],
]">

    <div class="card">

        <x-validation-errors class="mb-4"/>

        <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <x-label class="mb-2">
                    Código
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el código del cupon" name="code" value="{{old('code', $coupon->code)}}"/>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Tipo
                </x-label>
                <x-select name="type" class="w-full">
                    <option value="">Selecciona un tipo de cupón</option>
                    <option value="1" {{$coupon->type == 1 ? 'selected' : ''}}>Porcentaje</option>
                    <option value="2" {{$coupon->type == 2 ? 'selected' : ''}}>Monto Fijo</option>
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Valor
                </x-label>
                <x-input type="number" step="0.1" class="w-full" placeholder="Ingrese el valor del cúpon" name="value" value="{{old('value', $coupon->value)}}"/>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Stock
                </x-label>
                <x-input type="number" step="1" class="w-full" placeholder="Ingrese el stock del cúpon" name="stock" value="{{old('stock', $coupon->stock)}}"/>
            </div>

            <div class="mb-4">
                <x-label>
                    Fecha de inicio
                </x-label>
                <x-input type="date" name="start_at" value="{{old('start_at', $coupon->start_at->format('Y-m-d'))}}" class="w-full" />
            </div>
        
            <div class="mb-4">
                <x-label>
                    Fecha fin (opcional)
                </x-label>
                <x-input type="date" name="end_at" value="{{old('end_at', $coupon->end_at ? $coupon->end_at->format('Y-m-d') : '')}}" class="w-full" />
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Estado
                </x-label>
                <x-select name="status" class="w-full">
                    <option value="">Selecciona un estado</option>
                    <option value="0" {{$coupon->status == 0 ? 'selected' : ''}}>Inactivo</option>
                    <option value="1" {{$coupon->status == 1 ? 'selected' : ''}}>Activo</option>
                </x-select>
            </div>

            <div class="flex justify-end">

                <x-button>Actualizar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
