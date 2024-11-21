<div class="rounded-lg border border-gray-100 bg-white shadow-lg">
    <header class="border-b border-gray-200 px-6 py-2">
        <div class="flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-700">Imagenes</h1>
            <button class="btn btn-blue" wire:click="download()">Descargar</button>
        </div>
    </header>
    <div class="p-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        @foreach ($images as $image)
            <div class="relative" wire:key="images-{{$image->id}}">

                <div class="absolute top-0 right-0 p-2 bg-white rounded-bl-md text-red-500 hover:text-red-700 cursor-pointer"  wire:click="DeleteImage({{$image->id}})">
                    <label class="flex items-center cursor-pointer">
                        <i class="fa-solid fa-trash cursor-pointer"></i>
                    </label>
                </div>
                <img onclick="preview('{{Storage::disk('platforms')->url($image->url)}}')" src="{{Storage::disk('platforms')->url($image->url)}}" class="aspect-square object-cover object-center h-18 rounded-lg" alt="">
            </div>
        @endforeach
        
    </div>

    <div class="mt-4">
        {{ $images->links() }}
    </div>
</div>