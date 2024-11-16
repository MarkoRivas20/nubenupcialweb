<div>
    <x-slot name="action">
        <a class="btn btn-blue" href="{{route('admin.platforms.show', $platform)}}">Vista Previa</a>
    </x-slot>

    <x-validation-errors class="mb-4"/>

    <div class="bg-white rounded-lg shadow mb-4">
        <div class="px-6 pt-4">
            <div class="mb-4">
                <x-label class="mb-1">Documento del usuario</x-label>
                <x-input wire:model="userDocument" class="w-full" placeholder="Por favor, introduzca el documento del usuario"/>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Nombre</x-label>
                <x-input wire:model="name" class="w-full" placeholder="Por favor, introduzca el nombre de la plataforma"/>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Slug</x-label>
                <x-input wire:model="slug" class="w-full" placeholder="Por favor, introduzca el slug de la plataforma"/>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Título</x-label>
                <x-input wire:model="title" class="w-full" placeholder="Por favor, introduzca el título a mostrar"/>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Texto</x-label>
                <x-input wire:model="text" class="w-full" placeholder="Por favor, introduzca el texto a mostrar"/>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Cantidad de fotos por usuario</x-label>
                <x-input wire:model="qtyPhotos" type="number" class="w-full" placeholder="Por favor, introduzca la cantidad de fotos por usuario"/>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Cantidad de usuarios</x-label>
                <x-input wire:model="qtyUsers" type="number" class="w-full" placeholder="Por favor, introduzca la cantidad de usuarios"/>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Código de verificación</x-label>
                <div class="flex gap-2">
                    <x-input wire:model="verificationCode" class="w-full flex-1 mb-1" placeholder="Por favor, genere el código de verificación" disabled/>
                    <button wire:click="generateCode()" class="btn btn-blue">Generar código</button>
                </div>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Icono</x-label>
                <input type="file" accept="image/*" wire:model="icon" class="mb-1 p-1 w-full text-slate-500 text-sm rounded-full leading-6 file:bg-blue-200 file:text-blue-700 file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-full hover:file:bg-blue-100 border border-gray-300">
                @if ($platform->icon)
                <a class="text-xs -mt-2 ml-2 text-blue-500 hover:text-underline hover:text-blue-700" href="{{Storage::url($platform->icon)}}" target="_blank">Ver Imagen</a>
                @endif
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Primera imagen de Fondo</x-label>
                <input type="file" accept="image/*" wire:model="background" class="mb-1 p-1 w-full text-slate-500 text-sm rounded-full leading-6 file:bg-blue-200 file:text-blue-700 file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-full hover:file:bg-blue-100 border border-gray-300">
                @if ($platform->background)
                <a class="text-xs -mt-2 ml-2 text-blue-500 hover:text-underline hover:text-blue-700" href="{{Storage::url($platform->background)}}" target="_blank">Ver Imagen</a>
                @endif
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Segunda imagen de Fondo</x-label>
                <input type="file" accept="image/*" wire:model="background2" class="mb-1 p-1 w-full text-slate-500 text-sm rounded-full leading-6 file:bg-blue-200 file:text-blue-700 file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-full hover:file:bg-blue-100 border border-gray-300">
                @if ($platform->background2)
                <a class="text-xs -mt-2 ml-2 text-blue-500 hover:text-underline hover:text-blue-700" href="{{Storage::url($platform->background2)}}" target="_blank">Ver Imagen</a>
                @endif
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Logo</x-label>
                <input type="file" accept="image/*" wire:model="loadLogo" class="mb-1 p-1 w-full text-slate-500 text-sm rounded-full leading-6 file:bg-blue-200 file:text-blue-700 file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-full hover:file:bg-blue-100 border border-gray-300">
                @if ($platform->load_logo)
                <a class="text-xs -mt-2 ml-2 text-blue-500 hover:text-underline hover:text-blue-700" href="{{Storage::url($platform->load_logo)}}" target="_blank">Ver Imagen</a>
                @endif
            </div>
            <div class="mb-4">
                <x-label class="mb-1">Fondo de carga</x-label>
                <input type="file" accept="image/*" wire:model="loadBackground" class="mb-1 p-1 w-full text-slate-500 text-sm rounded-full leading-6 file:bg-blue-200 file:text-blue-700 file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-full hover:file:bg-blue-100 border border-gray-300">
                @if ($platform->load_background)
                <a class="text-xs -mt-2 ml-2 text-blue-500 hover:text-underline hover:text-blue-700" href="{{Storage::url($platform->load_background)}}" target="_blank">Ver Imagen</a>
                @endif
            </div>
            <div class="mb-4">
                <x-label class="mb-1">QR</x-label>
                <input type="file" accept="image/*" wire:model="qr" class="mb-1 p-1 w-full text-slate-500 text-sm rounded-full leading-6 file:bg-blue-200 file:text-blue-700 file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-full hover:file:bg-blue-100 border border-gray-300">
                @if ($platform->qr)
                <a class="text-xs -mt-2 ml-2 text-blue-500 hover:text-underline hover:text-blue-700" href="{{Storage::url($platform->qr)}}" target="_blank">Ver Imagen</a>
                @endif
            </div>
            <div class="mb-4">
                <x-label class="mb-1">
                    Estado
                </x-label>
                <x-select wire:model="status" class="w-full">
                    <option value="">Selecciona un estado</option>
                    <option value="0" {{$platform->status == 0 ? 'selected' : ''}}>Inactivo</option>
                    <option value="1" {{$platform->status == 1 ? 'selected' : ''}}>Activo</option>
                </x-select>
            </div>

            <div class="flex justify-end">
                <x-button wire:click="save">
                    Guardar
                </x-button>
            </div>
        </div>
    </div>
</div>
