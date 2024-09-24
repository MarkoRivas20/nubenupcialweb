<div x-data="{
    open: false,
}">
    <header class="bg-purple-600">

        <x-container class="px-4 py-4">
            <div class="flex justify-between items-center space-x-8">

                <button class="text-xl" x-on:click="open = true">
                    <i class="fas fa-bars text-white"></i>
                </button>

                <h1 class="text-white">
                    <a href="/" class="inline-flex flex-col items-end">
                        <span class="text-2xl leading-4 md:leading-6 font-semibold">
                            Nubenupcial
                        </span>
        
                        <span class="text-xs">
                            Tienda Online
                        </span>
                    </a>
                </h1>

                <div class="flex-1 hidden md:block">
                    <x-input class="w-full" placeholder="Buscar por producto"/>
                </div>

                <div class="flex items-center space-x-4 md:space-x-8">
                    
                    <x-dropdown>
                        <x-slot name="trigger">

                            @auth
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button class="text-xl">
                                    <i class="fas fa-user text-white"></i>
                                </button>
                            @endauth
                        </x-slot>

                        <x-slot name="content">

                            @guest
                                
                                <div class="px-4 py-2 ">
                                    <div class="flex justify-center">
                                        <a href="{{route('login')}}" class="btn btn-blue">
                                        Iniciar sesión
                                        </a>
                                    </div>

                                    <p class="text-sm text-center mt-2">
                                        ¿No tienes cuenta? <a href="{{route('register')}}" class="text-purple-600 hover:underline">Regístrate</a>
                                    </p>
                                </div>

                            @else

                                <x-dropdown-link href="{{route('profile.show')}}">
                                    Mi perfil
                                </x-dropdown-link>
                                <div class="border-t border-gray-200"></div>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
    
                                    <x-dropdown-link href="{{ route('logout') }}"
                                             @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            @endguest

                        </x-slot>
                    </x-dropdown>
                    
                    <button class="text-xl">
                        <i class="fas fa-shopping-cart text-white"></i>
                    </button>
                </div>
            </div>

            <div class="mt-4 md:hidden">
                <x-input class="w-full" placeholder="Buscar por producto"/>
            </div>
        </x-container>
    </header>

    <div x-show="open" x-on:click="open = false" style="display: none" class="fixed top-0 left-0 inset-0 bg-black bg-opacity-25 z-10"></div>

    <div x-show="open" style="display: none" class="fixed top-0 left-0 z-20 ">
        <div class="flex">
            <div class="w-screen md:w-80 h-screen bg-white">
                <div class="bg-purple-600 px-4 py-3 text-white font-semibold">
                    <div class="flex justify-between items-center">
                        <span class="text-lg">
                            ¡Hola!
                        </span>
    
                        <button x-on:click="open = false">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="h-[calc(100vh-52px)] overflow-auto">
                    <ul>
                        @foreach ($categories as $category)
                            <li>
                                <a href="" class="flex items-center justify-between px-4 py-4 text-gray-700 hover:bg-purple-200">
                                    {{$category->name}}
                                    <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div></div>
        </div>
    </div>
</div>
