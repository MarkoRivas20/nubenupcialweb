<div class="card">
    <div class="flex justify-between items-center">

        <h2 class="mb-1 text-xl font-semibold text-gray-600">Imagenes</h2>
        <div class="flex items-center">
            <span class="mr-2 mb-1">
                Usuario:
            </span>
            <x-select wire:model.live="userIdSelected" class="mb-1">
                @foreach ($platformUsers as $platformUser)
                    <option value="{{$platformUser->user->id}}">{{$platformUser->user->name." ".$platformUser->user->last_name}}</option>
                @endforeach
                
            </x-select>
            
                
            <button wire:click="download()" class="btn btn-blue ml-2">
                Descargar Imagenes
            </button>
        </div>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        @foreach ($images as $image)
            <div wire:key="images-{{$image->id}}"  onclick="preview('{{Storage::disk('platforms')->url($image->url)}}','{{$image->message}}')">

                <img src="{{Storage::disk('platforms')->url($image->url)}}" class="aspect-square object-cover object-center h-18 rounded-lg" alt="">
            </div>
        @endforeach
        
    </div>

    <div class="mt-4">
        {{ $images->links() }}
    </div>

    @push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/basicLightbox/5.0.0/basicLightbox.min.css" integrity="sha512-C+KPK958JmUdU8B9SVr8YpEZtQ1T1XrFX/OLvE/lt336DFWXFHL5Y9/tUewMEU+Uy3dUAS363XXLdBine0WDyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush
    
    @push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/basicLightbox/5.0.0/basicLightbox.min.js" integrity="sha512-jIc3kBeyfyLXBTmzUIXnbGiVK2wgWGcDIkJwkFW4bQ6v2h/piOKLwIfy3wOmKHWIu8DgYSKVth0DMUvExMYcOw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function preview(url,message){

            basicLightbox.create(`
		    <img src="`+url+`">
            <p class="text-white px-4 py-2 font-semibold">Mensaje:</p>
		    <p class="text-white px-4 py-2">`+message+`</p>`).show()
        }
    </script>
    
    @endpush
   
</div>
