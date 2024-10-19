<div>
    <x-validation-errors class="mb-4"/>
    
    @foreach ($templateSelected as $indexSection=>$section)
    <div class="bg-white rounded-lg shadow mb-4">
        <div class="bg-gray-100 border-b border-gray-300 rounded-t-lg overflow-auto flex items-center px-6 py-4 uppercase font-semibold justify-between">
            <span>
                {{$section['name']}}
            </span>
            <i class="fa-solid fa-trash text-red-500 cursor-pointer hover:text-red-700" wire:click="removeSection({{$indexSection}})"></i>
        </div>

        <div class="px-6 pt-4">
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-label class="mb-2">Tipo de Fondo</x-label>
        
                    <x-select class="w-full" wire:model="templateSelected.{{$indexSection}}.type_background">
                        <option value="" disabled>Seleccione un tipo de fondo</option>
                        <option value="1">Imagen</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>
    
                <div>
                    <x-label class="mb-2">
                        Fondo
                    </x-label>
                    <x-input class="w-full" placeholder="Ingrese el valor del fondo" wire:model="templateSelected.{{$indexSection}}.background"/>
                </div>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Descripción</x-label>
                <textarea class="w-full block" wire:model="templateSelected.{{$indexSection}}.body"></textarea>
            </div>
        </div>

        <div class="flex justify-end px-6">
            <button class="btn btn-blue" wire:click="addAttribute({{$indexSection}})">
                <i class="fa-solid fa-plus mr-2"></i>
                Agregar
            </button>
            
        </div>

        <div class="px-6 pb-4">
            @foreach ($section['attributes'] as $indexAttribute=>$attribute)
                
                <div class="mb-4">
                    <div class="flex space-x-2 items-center mb-2">
                        <i class="fa-solid fa-trash text-red-500 text-sm cursor-pointer hover:text-red-700" wire:click="removeAttribute({{$indexSection}},{{$indexAttribute}})"></i>
                        <x-label >
                            Tipo: 
                            <x-select class="h-6 py-0 px-2" wire:model="templateSelected.{{$indexSection}}.attributes.{{$indexAttribute}}.type">
                                <option value="" disabled>Seleccione un valor</option>
                                <option value="1">Texto</option>
                                <option value="2">Imagen</option>
                                <option value="3">Canción</option>
                            </x-select>
                        </x-label>
                    </div>
                    <div class="flex flex-col md:flex-row gap-4">
                        <x-input class="w-full md:w-52" wire:model="templateSelected.{{$indexSection}}.attributes.{{$indexAttribute}}.key" placeholder="Ingrese la key del campo"/>
                        <x-input class="flex-1" placeholder="Ingrese el valor del campo" wire:model="templateSelected.{{$indexSection}}.attributes.{{$indexAttribute}}.value"/>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endforeach

    <div class="flex justify-between">
        <x-primary-button wire:click="$set('openModal', true)">Añadir Sección</x-primary-button>
        <x-button wire:click="save">Guardar</x-button>
    </div>

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Agregar nueva sección
        </x-slot>

        <x-slot name="content">

            <div>
                <x-label class="mb-1">
                    Nombre
                </x-label>
                <x-input class="w-full" wire:model="nameSection"></x-input>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-danger-button wire:click="$set('openModal', false)">
                Cancelar
            </x-danger-button>

            <x-button class="ml-2" wire:click="addSection()">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
