<div>
    
    <div class="card">
        
        <x-validation-errors/>
        <div class="flex items-center justify-between space-x-4">
            <input class="mb-1 p-1 flex-1 text-slate-500 text-sm rounded-full leading-6 file:bg-blue-200 file:text-blue-700 file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-full hover:file:bg-blue-100 border border-gray-300" id="photos" name="photos" type="file" wire:model="photos" multiple >
            <button wire:click="uploadFiles" class="btn btn-blue flex-shrink-0" wire:loading.attr="disabled">
                Cargar archivos
            </button>

        </div>
    </div>

    @if ($resource->images->count())
        
        <div class="card mt-4">

            <h3 class="text-xl font-semibold text-gray-700">Archivos cargados</h3>

            <div class="p-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                @foreach ($resource->images as $image)
                    <div class="relative">
                        <div class="absolute top-0 right-0 p-2 bg-white rounded-bl-md text-red-500 hover:text-red-700 cursor-pointer" wire:click="DeleteImage({{$image->id}})">
                            <label class="flex items-center cursor-pointer">
                                <i class="fa-solid fa-trash "></i>
                            </label>
                        </div>

                        <div class="absolute top-0 left-0 p-2 bg-white rounded-br-md text-emerald-500 hover:text-emerald-700 cursor-pointer" >
                            <label class="flex items-center btn-copy cursor-pointer" data-clipboard-text="{{Storage::url($image->file_path)}}">
                                <i class="fa-solid fa-link"></i>
                            </label>
                        </div>
                        @if (str_contains($image->file_path, '.jpg') || str_contains($image->file_path, '.png') || str_contains($image->file_path, '.jpeg')|| str_contains($image->file_path, '.svg')|| str_contains($image->file_path, '.webp'))
                            
                            <img src="{{Storage::url($image->file_path)}}" class="aspect-square object-cover object-center h-18" alt="">

                        @else
                            <img src="{{asset('img/file-music.png')}}" class="aspect-square object-cover object-center h-18" alt="">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
        <script>
            var clipboard = new ClipboardJS('.btn-copy');
        </script>
    @endpush
</div>
