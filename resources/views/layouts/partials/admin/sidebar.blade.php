@php
    $links = [
        [
            'icon' => 'fa-solid fa-gauge',
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard')
        ],
        [
            'header' => 'Administrar configuración',
        ],
        [
            'icon' => 'fa-solid fa-gear',
            'name' => 'Configuración',
            'route' => route('admin.configurations.edit',1),
            'active' => request()->routeIs('admin.configurations.*')
        ],
        [
            'header' => 'Administrar usuarios',
        ],
        [
            'icon' => 'fa-solid fa-user',
            'name' => 'Usuarios',
            'route' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*')
        ],
        [
            'header' => 'Administrar página',
        ],
        [
            'icon' => 'fa-solid fa-box-open',
            'name' => 'Categorias',
            'route' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*')
        ],
        [
            'icon' => 'fa-solid fa-cog',
            'name' => 'Opciones',
            'route' => route('admin.options.index'),
            'active' => request()->routeIs('admin.options.*')
        ],
        [
            'icon' => 'fa-solid fa-box',
            'name' => 'Productos',
            'route' => route('admin.products.index'),
            'active' => request()->routeIs('admin.products.*')
        ],
        [
            'icon' => 'fa-solid fa-ticket-simple',
            'name' => 'Cupones',
            'route' => route('admin.coupons.index'),
            'active' => request()->routeIs('admin.coupons.*')
        ],
        [
            'icon' => 'fa-solid fa-images',
            'name' => 'Portadas',
            'route' => route('admin.covers.index'),
            'active' => request()->routeIs('admin.covers.*')
        ],
        [
            'header' => 'Administrar productos',
        ],
        [
            'icon' => 'fa-solid fa-box-open',
            'name' => 'Recursos',
            'route' => route('admin.resources.index'),
            'active' => request()->routeIs('admin.resources.*')
        ],
        [
            'icon' => 'fa-solid fa-file',
            'name' => 'Plantillas',
            'route' => route('admin.templates.index'),
            'active' => request()->routeIs('admin.templates.*') || request()->routeIs('admin.sections.*')
        ],
        [
            'icon' => 'fa-solid fa-envelope',
            'name' => 'Invitaciones',
            'route' => route('admin.invitations.index'),
            'active' => request()->routeIs('admin.invitations.*')
        ],
        [
            'icon' => 'fa-solid fa-camera',
            'name' => 'Plataformas',
            'route' => route('admin.platforms.index'),
            'active' => request()->routeIs('admin.platforms.*')
        ],
        [
            'header' => 'Administrar ordenes',
        ],
        [
            'icon' => 'fa-solid fa-shopping-cart',
            'name' => 'Ordenes',
            'route' => route('admin.orders.index'),
            'active' => request()->routeIs('admin.orders.*') 
        ]
    ];
@endphp

<aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        :class="{
            'translate-x-0 ease-out': sidebarOpen,
            '-translate-x-full ease-in': !sidebarOpen
        }"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                @foreach ($links as $link)
                    
                <li>
                    @isset($link['header'])
                        <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">
                            {{$link['header']}}
                        </div>
                    @else
                        <a href="{{$link['route']}}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{$link['active'] ? 'bg-gray-100' : ''}}">
                            <span class="inline-flex w-6 h-6 justify-center items-center">
                                <i class="{{$link['icon']}} text-gray-500"></i>
                            </span>
                            <span class="ml-2">{{$link['name']}}</span>
                        </a>
                    @endisset
                </li>
                @endforeach
                
            </ul>
        </div>
    </aside>