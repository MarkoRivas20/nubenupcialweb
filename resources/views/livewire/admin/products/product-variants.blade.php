<div>
    <section class="rounded-lg border border-gray-100 bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">Opciones</h1>
                <x-button wire:click="$set('openModal', true)">
                    Nuevo
                </x-button>
            </div>
        </header>
        <div class="p-6">
            @if ($product->options->count())
                
                <div class="space-y-6">
                    @foreach ($product->options as $option)
                        <div wire:key="product-option-{{$option->id}}" class="p-6 rounded-lg border border-gray-200 relative">

                            <div class="absolute -top-3 bg-white px-4">
                                <button onclick="confirmDeleteOption({{$option->id}})">
                                    <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                                </button>
                                <span class="ml-2">
                                    {{$option->name}}
                                </span>
                            </div>

                            <div class="flex flex-wrap">
                                @foreach ($option->pivot->features as $feature)
                                    <div wire:key="option-{{$option->id}}-feature-{{$feature['id']}}">
                                        @switch($option->type)
                                            @case(1)
                                            
                                                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                                    {{$feature['description']}}
    
                                                    <button class="ml-0.5" onclick="confirmDeleteFeature({{$option->id}},{{$feature['id']}})">
                                                        <i class="fa-solid fa-xmark hover:text-red-500"></i>
                                                    </button>
                                                </span>
            
                                                @break
                                            @case(2)
    
                                            <div class="relative">
                                                <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4" style="background-color: {{$feature['value']}}"></span>
                                                <button class="absolute z-10 left-3 -top-2 rounded-full bg-red-500 hover:bg-red-600 h-4 w-4 flex justify-center items-center" 
                                                onclick="confirmDeleteFeature({{$option->id}},{{$feature['id']}})">
                                                    <i class="fa-solid fa-xmark text-white text-xs"></i>
                                                </button>
                                            </div>
            
                                                
                                                @break
                                            @default
                                                
                                        @endswitch

                                    </div>
                                                                       
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Alerta!</span> Todavia no hay opciones para el producto.
                </div>
            @endif
        </div>
    </section>

    @if ($product->variants->count())
    
        <section class="rounded-lg border border-gray-100 bg-white shadow-lg mt-12">
            <header class="border-b border-gray-200 px-6 py-2">
                <div class="flex justify-between">
                    <h1 class="text-lg font-semibold text-gray-700">Variantes</h1>
                </div>
            </header>
            <div class="p-6">
                <ul class="divide-y -my-4">
                    @foreach ($product->variants as $item)
                        <li class="py-4 flex items-center">
                            <img src="{{$item->image}}" class="w-12 h-12 object-cover object-center">
                            
                            <p class="divide-x">
                                @foreach ($item->features as $feature)
                                    <span class="px-3">
                                        {{$feature->description}}
                                    </span>
                                @endforeach
                            </p>

                            <a href="{{route('admin.products.variants', [$product,$item])}}" class="ml-auto btn btn-blue">Editar</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Agregar nueva opción
        </x-slot>

        <x-slot name="content">

            <x-validation-errors></x-validation-errors>

            <div class="mb-4">
                <x-label class="mb-1">
                    Opción
                </x-label>

                <x-select class="w-full" wire:model.live="variant.option_id">
                    <option value="" disabled>Selecciona una opción</option>
                    @foreach ($options as $option)
                        <option value="{{$option->id}}">
                            {{$option->name}}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="flex items-center mb-6">
                <hr class="flex-1">
                <span class="mx-4">Valores</span>
                <hr class="flex-1">

            </div>

            <ul class="mb-4 space-y-4">
                @foreach ($variant['features'] as $index => $feature)
                    <li wire:key="variant-feature-{{$index}}" class="border border-gray-200 rounded-lg p-6 relative">


                        <div class="absolute -top-3 bg-white px-4">

                            <button wire:click="removeFeature({{$index}})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                            </button>

                        </div>

                        <div>
                            <x-label class="mb-1">
                                Valores
                            </x-label>

                            <x-select class="w-full" wire:model="variant.features.{{$index}}.id" wire:change="feature_change({{$index}})">

                                <option value="">Seleccione un valor</option>

                                @foreach ($this->features as $feature)
                                    <option value="{{$feature->id}}">
                                        {{$feature->description}}
                                    </option>
                                @endforeach

                            </x-select>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="flex justify-end">
                <x-button wire:click="addFeature">
                    Agregar valor
                </x-button>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-danger-button wire:click="$set('openModal', false)">
                Cancelar
            </x-button>

            <x-button class="ml-2" wire:click="save">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDeleteFeature(option_id, feature_id){
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡No podrás revertir esto",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, ¡bórralo!",
                    cancelButtonText:"Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {

                        @this.call('deleteFeature',option_id, feature_id)
                        
                    }
                });
            }

            function confirmDeleteOption(option_id){
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡No podrás revertir esto",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, ¡bórralo!",
                    cancelButtonText:"Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {

                        @this.call('deleteOption',option_id)
                        
                    }
                });
            }
        </script>
    @endpush
</div>
