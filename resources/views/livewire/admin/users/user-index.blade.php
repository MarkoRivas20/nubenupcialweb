<div>

    <div class="px-6 py-4">
        <x-input type="text" class="w-full" placeholder="Escriba el nombre para filtrar" wire:model.live="search" />
    </div>
    
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre Completo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            DNI
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Celular
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rol
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->name . ' ' . $user->last_name }}
                            </td>
                            <td class="px-6 py-4">
                                @switch($user->document_type)
                                    @case(1)
                                        DNI {{ $user->document }}
                                    @break

                                    @case(2)
                                        RUC {{ $user->document }}
                                    @break

                                    @default
                                        DESCONOCIDO
                                @endswitch

                            </td>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->phone }}
                            </td>
                            <td class="px-6 py-4">
                                @switch($user->roles->first()->name)
                                    @case('admin')
                                        Administrador
                                    @break

                                    @case('user')
                                        Usuario
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>
                                <a class="btn btn-blue" href="{{route('admin.users.edit', $user)}}">
                                    Editar
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">

                                    No existen registros
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
            </table>
        </div>

            
        <div class="mt-4">
                {{ $users->links() }}
        </div>
        

    </div>
