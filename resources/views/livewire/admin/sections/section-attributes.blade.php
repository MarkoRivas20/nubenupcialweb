<div class="card">
    <section class="rounded-lg border border-gray-100 bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">Atributos</h1>
                <x-button wire:click="$set('openModal', true)">
                    Nuevo
                </x-button>
            </div>
        </header>
        <div class="p-6">
            @if ($section->attributes->count())
                
                <div class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($section->attributes as $attribute)

                        <div wire:key="section-attribute-{{$attribute->id}}" class="px-6 pt-6 pb-3 rounded-lg border border-gray-200 relative">

                            <div class="absolute -top-3 bg-white px-4">
                                <button onclick="confirmDeleteAttribute({{$attribute->id}})">
                                    <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                                </button>
                                <span class="ml-2">
                                    @switch($attribute->type)
                                        @case(1)
                                            Texto
                                            @break
                                        @case(2)
                                            Foto
                                            @break
                                        @case(3)
                                            Canción
                                            @break
                                        @default
                                            
                                    @endswitch
                                </span>
                            </div>

                            <span>
                                {{$attribute->key}}
                            </span>
                        </div>

                    @endforeach
                </div>
            @else
                <div class="p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Alerta!</span> Todavia no hay atributos para la plantilla.
                </div>
            @endif
        </div>
    </section>

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Agregar nuevo atributo
        </x-slot>

        <x-slot name="content">

            <x-validation-errors></x-validation-errors>

            <ul class="mb-4 space-y-4">
                @foreach ($item['attributes'] as $index => $attribute)
                    <li wire:key="section-attribute-{{$index}}" class="border border-gray-200 rounded-lg p-6 relative">

                        <div class="absolute -top-3 bg-white px-4">

                            <button wire:click="removeAttribute({{$index}})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                            </button>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label class="mb-1">
                                    Tipo
                                </x-label>
    
                                <x-select class="w-full" wire:model="item.attributes.{{$index}}.type">
    
                                    <option value="">Seleccione un valor</option>
                                    <option value="1">Texto</option>
                                    <option value="2">Imagen</option>
                                    <option value="3">Canción</option>
    
                                </x-select>
                            </div>
                            <div>
                                <x-label class="mb-1">
                                    Key
                                </x-label>
                                <x-input class="w-full" wire:model="item.attributes.{{$index}}.key"></x-input>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="flex justify-end">
                <x-button wire:click="addAttribute">
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
            function confirmDeleteAttribute(attribute_id){
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

                        @this.call('deleteAttribute',attribute_id)
                        
                    }
                });
            }
        </script>
    @endpush
</div>
