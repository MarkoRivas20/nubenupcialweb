<div>
    <x-validation-errors class="mb-4"/>

    <x-slot name="action">
        <a class="btn btn-blue" href="{{route('admin.invitations.show', $invitation)}}">Vista Previa</a>
    </x-slot>

    <div class="bg-white rounded-lg shadow mb-4">
        <div class="bg-gray-100 border-b border-gray-300 rounded-t-lg overflow-auto flex items-center px-6 py-4 uppercase font-semibold justify-between">
            <span>
                DATOS DE LA INVITACIÓN
            </span>

        </div>
        <div class="px-6 pt-4 grid grid-cols-1 lg:grid-cols-3 gap-4 pb-4">
            <div>
                <x-label class="mb-1">Nombre</x-label>
                <x-input wire:model="invitationName" class="w-full" placeholder="Por favor, introduzca el nombre de la invitación"/>
            </div>
            <div>
                <x-label class="mb-1">Slug</x-label>
                <x-input wire:model="invitationSlug" class="w-full" placeholder="Por favor, introduzca el slug de la invitación"/>
            </div>
            <div>
                <x-label class="mb-1">
                    Estado
                </x-label>
                <x-select wire:model="invitationStatus" class="w-full">
                    <option value="">Selecciona un estado</option>
                    <option value="0" {{$invitationStatus == 0 ? 'selected' : ''}}>Inactivo</option>
                    <option value="1" {{$invitationStatus == 1 ? 'selected' : ''}}>Activo</option>
                </x-select>
            </div>
        </div>

        <div class="px-6 pt-4 grid grid-cols-1 lg:grid-cols-2 gap-4 pb-4">
            <div class="mb-4">
                <x-label class="mb-1">Icono</x-label>
                <input type="file" accept="image/*" wire:model="image" class="mb-1 p-1 w-full text-slate-500 text-sm rounded-full leading-6 file:bg-blue-200 file:text-blue-700 file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-full hover:file:bg-blue-100 border border-gray-300">
                @if ($invitationIcon)
                <a class="text-xs -mt-2 ml-2 text-blue-500 hover:text-underline hover:text-blue-700" href="{{Storage::url($invitationIcon)}}" target="_blank">Ver Imagen</a>
                @endif
            </div>
        </div>
    </div>

    <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
        <span class="font-medium">Recuerda!</span> Solo se puede cambiar el orden si haz guardado los cambios antes
      </div>

    <ul id="sections">

        @foreach ($invitationSelected as $indexSection=>$section)
            <li data-id="{{$section['id']}}" class="bg-white rounded-lg shadow mb-4" wire:key="section-{{$section['id']}}" x-data="{open: false}">
                <div x-on:click="open = !open" class="bg-gray-100 border-b border-gray-300 rounded-t-lg overflow-auto flex items-center px-6 py-4 uppercase font-semibold justify-between">
                    <span>
                        {{$section['name']}}
                    </span>
                    <div class="flex items-center space-x-4">
                        @if ($section['id'])
                            
                            <a href="{{route('admin.invitations.images.index', [$invitation,$section['id']])}}" target="_blank">
                                <i class="fa-solid fa-box-archive text-blue-500 cursor-pointer hover:text-blue-700"></i>
                            </a>
                        @endif
                        <i class="fa-solid fa-trash text-red-500 cursor-pointer hover:text-red-700" wire:click="removeSection({{$indexSection}})"></i>
                    </div>
                </div>
    
                <div x-show="open" x-cloak>
                    <div class="px-6 pt-4">
                        <div class="mb-4">
                            <x-label class="mb-1">Descripción</x-label>
                            <textarea rows="15" class="w-full block" wire:model="invitationSelected.{{$indexSection}}.body"></textarea>
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
                                        <x-select class="h-6 w-48 py-0 px-2" wire:model="invitationSelected.{{$indexSection}}.attributes.{{$indexAttribute}}.type">
                                            <option value="" disabled>Seleccione un valor</option>
                                            <option value="1">Texto</option>
                                            <option value="2">Imagen</option>
                                            <option value="3">Canción</option>
                                        </x-select>
                                    </x-label>
                                </div>
                                <div class="flex flex-col md:flex-row gap-4">
                                    <x-input class="w-full md:w-52" wire:model="invitationSelected.{{$indexSection}}.attributes.{{$indexAttribute}}.key" placeholder="Ingrese la key del campo"/>
                                    <x-input class="flex-1" placeholder="Ingrese el valor del campo" wire:model="invitationSelected.{{$indexSection}}.attributes.{{$indexAttribute}}.value"/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
    
            </li>
        @endforeach
    </ul>

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

    @push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.3/Sortable.min.js"></script>
    <script>
        new Sortable(sections, {
            animation: 150,
            ghostClass: 'bg-blue-100',
            store: {
                set: (sorteable) => {
                    const sorts = sorteable.toArray();

                    axios.post("{{route('api.sort.sections')}}", {
                        sorts: sorts
                    }).catch((error)=> {
                        console.log(error);
                    });
                }
            }
        });
    </script>
@endpush
</div>
