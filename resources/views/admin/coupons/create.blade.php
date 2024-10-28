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
        'name' => 'Nuevo'
    ]
]">  

    <div class="card">

        <x-validation-errors class="mb-4"/>

        <form action="{{route('admin.coupons.store')}}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label class="mb-2">
                    Código
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el código del cupon" name="code" value="{{old('code')}}"/>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Tipo
                </x-label>
                <x-select name="type" class="w-full">
                    <option value="">Selecciona un tipo de cupón</option>
                    <option value="1">Porcentaje</option>
                    <option value="2">Monto Fijo</option>
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Valor
                </x-label>
                <x-input type="number" step="0.1" class="w-full" placeholder="Ingrese el valor del cúpon" name="value" value="{{old('value')}}"/>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Stock
                </x-label>
                <x-input type="number" step="1" class="w-full" placeholder="Ingrese el stock del cúpon" name="stock" value="{{old('stock')}}"/>
            </div>

            <div class="mb-4">
                <x-label>
                    Fecha de inicio
                </x-label>
                <x-input type="date" name="start_at" value="{{old('start_at')}}" class="w-full" />
            </div>
        
            <div class="mb-4">
                <x-label>
                    Fecha fin (opcional)
                </x-label>
                <x-input type="date" name="end_at" value="{{old('end_at')}}" class="w-full" />
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Estado
                </x-label>
                <x-select name="status" class="w-full">
                    <option value="">Selecciona un estado</option>
                    <option value="0">Inactivo</option>
                    <option value="1">Activo</option>
                </x-select>
            </div>

            <div class="flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
