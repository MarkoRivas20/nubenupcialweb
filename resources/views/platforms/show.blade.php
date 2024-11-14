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

    <div class="h-svh animate__animated animate__fadeIn" id="bodyPage" style="display: none">
        <div class="h-svh flex flex-col justify-between" style="background-image: url('/storage/{{ $platform->background }}'); background-position: center; background-repeat: no-repeat; background-size: cover; background-color: #fffdf8; ">
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
                    <div class="flex items-center rounded-full bg-white cursor-pointer h-10 px-4" (click)="comprobar(fileInput)">
                        <div class="m-auto text-base">
                            <span class="font-bold font-handlee">Tomar Foto</span>
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                            <input #fileInput type="file" accept="image/*" capture="camera" id="camera" hidden />

                        </div>
                    </div>
                </div>

                <div class="absolute bg-gray-800/90 h-10 w-10 left-6 flex items-center rounded-full border border-gray-900/90"
                     (click)="comprobar(galleryInput)">
                    <i class="fa-regular fa-images m-auto text-gray-100"></i>
                    <input #galleryInput type="file" accept="image/*" id="gallery" hidden />
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        setTimeout(() => {
            document.getElementById("loadPage").style.display = "none";
            document.getElementById("bodyPage").style.display = "block";

        }, 3100);

    </script>

</body>

</html>
