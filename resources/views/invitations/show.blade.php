<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$invitation->name}}</title>
    <link rel="icon" type="image/x-icon" href="{{Storage::url($invitation->icon)}}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <!-- Styles -->
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

  <link href="{{ asset('/css/invitations.css') }}" rel="stylesheet">
</head>
<body>

    <div id="loadPage" class="h-svh animate__animated animate__fadeOut animate__delay-2s" style="background-image: url('/storage/{{$invitation->load_background}}'); background-position: center; background-repeat: no-repeat; background-size: cover; background-color: #fffdf8;"> 
        <div class="h-svh w-full relative flex justify-center items-center animate__animated animate__fadeIn">
            <div class="absolute animate-spin rounded-full h-40 w-40 border-t-4 border-b-4 border-amber-500"></div>
            <img src="{{Storage::url($invitation->load_logo)}}"  class="rounded-full" height="112" width="112" priority>
          </div>
    </div>

    <div class="animate__animated animate__fadeIn" id="bodyPage" style="display: none">

        @livewire('invitations.invitation-show', ['invitation' => $invitation])
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    @livewireScripts

    <script>
        setTimeout(() => {
            document.getElementById("loadPage").style.display = "none";
            document.getElementById("bodyPage").style.display = "block";

            AOS.init();
        }, 3100);

    </script>

</body>
</html>

