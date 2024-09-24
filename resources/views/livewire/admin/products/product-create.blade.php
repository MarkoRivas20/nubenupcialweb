<div>

    <form wire:submit="store">

        <figure class="mb-4 relative">
    
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar imagen
    
                    <input type="file" 
                    accept="image/*"
                    class="hidden" 
                    wire:model="image">
                </label>
            </div>
    
            <img class="aspect-[16/9] object-cover object-center w-full" 
                src="{{ $image ? $image->temporaryUrl() : asset('img/no-image.png')}}" 
                alt="">
        </figure>

        <x-validation-errors class="mb-4"/>
    
        <div class="card">
        
            <div class="mb-4">
                <x-label class="mb-1">Código</x-label>
                <x-input wire:model="product.sku" class="w-full" placeholder="Por favor, introduzca el código del producto"/>
            </div>
        
            <div class="mb-4">
                <x-label class="mb-1">Nombre</x-label>
                <x-input wire:model="product.name" class="w-full" placeholder="Por favor, introduzca el nombre del producto"/>
            </div>
        
            <div class="mb-4">
                <x-label class="mb-1">Categoria</x-label>
                
                <x-select class="w-full" wire:model=product.category_id>
                    <option value="" disabled>Seleccione una Categoría</option>
                    @foreach ($categories as $category)
                        
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </x-select>
            </div>
        
            <div class="mb-4" wire:ignore>
                <x-label class="mb-1">Descripción</x-label>
                <textarea wire:model="product.description" id="detail">{{$product['description']}}</textarea>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">Precio</x-label>
                <x-input type="number" step="0.01" wire:model="product.price" class="w-full" placeholder="Por favor, introduzca el precio del producto"/>
            </div>
        
            <div class="flex justify-end">
                <x-button wire:click="store">
                    Crear producto
                </x-button>
            </div>
        
            
        </div>
    </form>

    @push('js')
        <script>
            ClassicEditor
                    .create(document.querySelector('#detail'))
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                        @this.set('product.description', editor.getData());
                    })
                    })
                    .catch(error => {
                        console.error('Error during initialization of the editor', error);
                    });
        </script>
    @endpush
</div>

