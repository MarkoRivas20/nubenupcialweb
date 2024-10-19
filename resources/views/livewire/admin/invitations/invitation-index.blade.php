
<div>
    <div class="flex justify-end px-6 py-2">
    
        <button class="btn btn-blue" wire:click="$set('openModal', true)">
            Nuevo
        </button>
    </div>
    <div class="card" >
    
        <section class="rounded-lg border border-gray-100 bg-white shadow-lg">
            
            <div>
                @if ($invitations->count())
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Estado
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invitations as $invitation)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$invitation->id}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$invitation->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($invitation->status)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Activo</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($invitation->status)
                                            
                                        <a href="{{route('admin.invitations.edit', $invitation)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
        
                <div class="mt-4">
                    {{$invitations->links()}}
                </div>
            @else
                <div class="p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Alerta!</span> Todavia no hay invitaciones registradas.
                </div>
            @endif
            </div>
        </section>
    
        
            <x-dialog-modal wire:model="openModal">
                <x-slot name="title">
                    Seleccionar Plantilla
                </x-slot>
        
                <x-slot name="content">
        
                    <x-label class="mb-1">
                        Plantillas
                    </x-label>
        
                    <x-select class="w-full" wire:model="templateSelected">
        
                        <option value="">Seleccione una plantilla</option>
                        @foreach ($templates as $template)
                            <option value="{{$template->id}}">{{$template->name}}</option>
                        @endforeach
        
                    </x-select>
        
                </x-slot>
        
                <x-slot name="footer">
                    <x-danger-button wire:click="$set('openModal', false)">
                        Cancelar
                    </x-button>
        
                    <x-button class="ml-2" wire:click="createInvitation()">
                        Seleccionar
                    </x-button>
                </x-slot>
            </x-dialog-modal>
    </div>
</div>
