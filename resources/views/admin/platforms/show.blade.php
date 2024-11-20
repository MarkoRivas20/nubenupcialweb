<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $platform->title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ Storage::url($platform->icon) }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/brittanyagustina" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:ital@0;1&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Corben:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Licorice&display=swap" rel="stylesheet">

  <link href="{{ asset('/css/platforms.css') }}" rel="stylesheet">
</head>

<body>
    
    <div id="loadPage" class="h-svh animate__animated animate__fadeOut animate__delay-2s"
        style="background-image: url('/storage/{{ $platform->load_background }}'); background-position: center; background-repeat: no-repeat; background-size: cover; background-color: #fffdf8;">
        <div class="h-svh w-full relative flex justify-center items-center animate__animated animate__fadeIn">
            <div class="absolute animate-spin rounded-full h-40 w-40 border-t-4 border-b-4 border-amber-500"></div>
            <img src="{{ Storage::url($platform->load_logo) }}" class="rounded-full" height="112" width="112"
                priority>
        </div>
    </div>

    <div id="bodyPage" class="h-svh" style="display: none">

        <div id="Container-1" class="h-svh animate__animated animate__fadeIn">
            <div id="Page-1" class="h-svh flex flex-col justify-between" style="background-image: url('/storage/{{ $platform->background }}'); background-position: center; background-repeat: no-repeat; background-size: cover; background-color: #fffdf8; ">
                <div class="bg-gradient-inverse flex text-white pl-2 pt-px h-16 animate__animated animate__slideInDown animate__delay-1s">
                    <div class="flex" style="margin-top: 2px;">
                        <span class="text-4xl font-bold font-handlee">{{$platform->qty_photos - $imagesCount}}</span>
                    </div>
                    <div class="flex flex-col ml-1 text-sm pt-1.5 font-handlee">
                        <div class="-mt-px">
                            <span>Fotos</span>
                        </div>
                        <div class="-mt-0.5">
                            <span>Restantes</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient flex flex-col h-96 justify-end items-center pb-6 gap-3 px-6 animate__animated animate__slideInUp animate__delay-1s">
                    <span class="text-bold text-3xl text-white font-handlee">{{ $platform->title }}</span>
                    <span class="text-bold text-xl text-white font-handlee">{{ $platform->text }}</span>
                    <div class="w-full mb-2">
                        <input type="text" value="{{$userName}}" class="font-handlee block w-full px-4 py-3 text-gray-200 border-2 border-gray-900/80 rounded-lg bg-gray-800/80 text-base focus:ring-white focus:outline-none focus:border-white" disabled>
                        <span class="text-sm text-gray-500 italic font-handlee">* Los novios podrán conocer de quien es la foto</span>
                    </div>
                    <div class="w-44">
                        <div class="flex items-center rounded-full bg-white cursor-pointer h-10 px-4" onclick="cameraInput()">
                            <div class="m-auto text-base">
                                <span class="font-bold font-handlee">Tomar Foto</span>
                                <i class="fa-solid fa-arrow-right ml-2"></i>
                                
    
                            </div>
                        </div>
                    </div>
    
                    <div class="absolute bg-gray-800/90 h-10 w-10 left-6 flex items-center rounded-full border border-gray-900/90"
                         onclick="galleryInput()">
                        <i class="fa-regular fa-images m-auto text-gray-100"></i>
                        
                    </div>
                    
                    
                </div>
            </div>
        </div>

        <div id="Page-2" class="h-svh bg-blue-200 animate__animated animate__fadeIn hidden"  style="background-image: url('/storage/{{ $platform->background2 }}'); background-position: center; background-repeat: no-repeat; background-size: cover; background-color: #fffdf8; ">
            
            <form action="{{route('admin.platforms.store', $platform)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="hidden" type="file" accept="image/*" id="gallery" name="image" onchange="previewImage(event, '#imgPreview')"/>
                <input class="hidden" type="file" accept="image/*" capture="camera" id="camera" name="image" onchange="previewImage(event, '#imgPreview')"/>
                <div class="h-full flex flex-col justify-between">
                    <i class="fa-solid fa-arrow-left ml-4 mt-3 text-2xl text-gray-700" onclick="hiddenPage2()"></i>
                    <div class="flex flex-col items-center mx-6 -mt-2">
                    
                    <img id="imgPreview" class="photo rounded-lg w-7/12 mb-6">
                    <textarea rows="4" class="w-full p-4 text-gray-700 border-2 border-amber-800/50 rounded-lg bg-[#FDF4E8]/80 text-base focus:ring-amber focus:outline-none focus:border-amber-800" name="message" placeholder="Escribe un mensaje para los novios..."></textarea>
                    <div class="w-full">
                        <span class="text-sm text-gray-500 italic text-left font-handlee">* Opcional</span>
                
                    </div>
                    </div>
                    
                    <div class="flex items-center mb-4 font-handlee">
                    <button type="submit" class="rounded-full bg-[#FEEAD9] border border-[#F4D6BE] cursor-pointer h-12 px-4 w-40 m-auto shadow-md">
                        <span>Enviar Foto</span>
                        <i class="fa-solid fa-upload ml-2"></i>
                    </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($errors->any())
        <script>
            Swal.fire({
                position: "top-end",
                html: `
                <div class="flex text-white gap-2 items-center">
                    <div>
                        <i class="fa-solid fa-x text-xl"></i>
                    </div>
                    <div class="text-center flex-1">
                        ¡Ha ocurrido un error!
                    </div>
                </div>
                `,
                showConfirmButton: false,
                background: "#FF0000",
                timer: 2500
                });
        </script>
    @endif

    @if (session('swal'))
        <script>

            response = "{{session('swal')}}"

            if ( response == 'ok') {
                Swal.fire({
                position: "top-end",
                html: `
                <div class="flex text-white gap-2 items-center">
                    <div>
                        <i class="fa-solid fa-check text-xl"></i>
                    </div>
                    <div class="text-center flex-1">
                        ¡Gracias por confirmar!
                    </div>
                </div>
                `,
                showConfirmButton: false,
                background: "#12EA00",
                timer: 2500
                });
            } else if(response == 'error'){
                Swal.fire({
                position: "top-end",
                html: `
                <div class="flex text-white gap-2 items-center">
                    <div>
                        <i class="fa-solid fa-x text-xl"></i>
                    </div>
                    <div class="text-center flex-1">
                        ¡Ha ocurrido un error!
                    </div>
                </div>
                `,
                showConfirmButton: false,
                background: "#FF0000",
                timer: 2500
                });
            }
            
        </script>
    @endif

    <script>

        setTimeout(() => {
            document.getElementById("loadPage").style.display = "none";
            document.getElementById("bodyPage").style.display = "block";

        }, 3100);

        function cameraInput(){
            
            document.getElementById("camera").click();
        }

        function galleryInput(){
            
            document.getElementById("gallery").click();
        }

        function previewImage(event, querySelector){

            const input = event.target;
            $imgPreview = document.querySelector(querySelector);
            if(!input.files.length) return
            file = input.files[0];
            objectURL = URL.createObjectURL(file);
            $imgPreview.src = objectURL;

            document.getElementById("Container-1").classList.add('hidden');
            document.getElementById("Container-1").classList.add('delay-1000');
            document.getElementById("Page-1").classList.add('animate__animated');
            document.getElementById("Page-1").classList.add('animate__fadeOut');
            document.getElementById("Page-1").classList.add('animate__delay-1s');

            document.getElementById("Page-2").classList.add('flex');
            document.getElementById("Page-2").classList.add('flex-col');
            document.getElementById("Page-2").classList.remove('hidden');

        }

        function hiddenPage2(){
            document.getElementById("Page-2").classList.remove('flex');
            document.getElementById("Page-2").classList.remove('flex-col');
            document.getElementById("Page-2").classList.add('hidden');

            document.getElementById("Container-1").classList.remove('delay-1000');
            document.getElementById("Container-1").classList.remove('hidden');
            document.getElementById("Page-1").classList.remove('animate__animated');
            document.getElementById("Page-1").classList.remove('animate__fadeOut');
            document.getElementById("Page-1").classList.remove('animate__delay-1s');

            document.getElementById('camera').value=null;
            document.getElementById('gallery').value=null;
        }


    </script>

</body>

</html>
