<div class="mt-6">
    <section class="rounded-lg border border-gray-100 bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">Imagenes</h1>
                <x-button wire:click="$set('openModalImages', true)">
                    Nuevo
                </x-button>
            </div>
        </header>
        <div class="p-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach ($product->images as $image)
                <div class="relative">

                    <div class="absolute top-0 right-0 p-2 bg-white rounded-bl-md text-red-500 hover:text-red-700 cursor-pointer"  wire:click="DeleteImage({{$image->id}})">
                        <label class="flex items-center ">
                            <i class="fa-solid fa-trash "></i>
                        </label>
                    </div>
                    <img src="{{Storage::url($image->file_path)}}" class="aspect-square object-cover object-center h-18" alt="">
                </div>
            @endforeach
            
        </div>
    </section>

    <x-dialog-modal wire:model="openModalImages">
        <x-slot name="title">
            Agregar imagenes
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-label class="mb-1">
                    Imagen
                </x-label>
                <input accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="photos" name="photos" type="file" wire:model="photos" multiple>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG (MAX. 800x400px).</p>
                <x-input-error for="photos"></x-input-error>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-danger-button wire:click="$set('openModalImages', false)">
                Cancelar
            </x-button>

            <x-button class="ml-2" wire:click="uploadPhotos">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
