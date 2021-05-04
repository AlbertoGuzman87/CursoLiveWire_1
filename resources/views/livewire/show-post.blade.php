<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 py-12">
    <x-table>
        <div class="px-6 py-4 flex items-center">
            <x-jet-input class="flex-1 mr-4" placeholder="Buscar..." type="text" wire:model="search" />
            @livewire('create-post')
        </div>
        @if ($lisPost->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="ordenar('id')">
                            ID

                            {{-- Icono ordena por --}}
                            @if ($ordenanaBy == 'id')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @endif

                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                            {{-- Fin icono ordena por --}}
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="ordenar('titulo')">
                            Título

                            {{-- Icono ordena por --}}
                            @if ($ordenanaBy == 'titulo')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @endif

                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                            {{-- Fin icono ordena por --}}

                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="ordenar('contenido')">
                            Contenido

                            {{-- Icono ordena por --}}
                            @if ($ordenanaBy == 'contenido')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @endif

                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                            {{-- Fin icono ordena por --}}
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($lisPost as $itempost)

                        <tr>
                            <td class="px-6 py-4 ">
                                <div class="text-sm text-gray-900">
                                    {{ $itempost->id }}
                                </div>
                            </td>
                            <td class="px-6 py-4 ">
                                <div class="text-sm text-gray-900">
                                    {{ $itempost->titulo }}
                                </div>
                            </td>
                            <td class="px-6 py-4 ">
                                <div class="text-sm text-gray-900">
                                    {{ $itempost->contenido }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap  text-sm font-medium">
                                {{-- @livewire('edit-post', ['post_id' => $post], key($post->id)) --}}
                                <a class="btn btn-green" wire:click="edit({{ $itempost }})">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>

        @else
            <div class="px-6 py-4">
                ¡No hay registros coinsidentes!
            </div>
        @endif

        {{-- Valida que almenos exita una paginación para mostrar --}}
        @if ($lisPost->hasPages())

            <div class="px-6 py-3">
                {{ $lisPost->links() }}
            </div>

        @endif


    </x-table>



    {{-- Modal para editar post --}}
    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name='title'>
            Editar Post
        </x-slot>

        <x-slot name='content'>

            <div wire:loading wire:target="imagen"
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">¡Imagen Cargando! </strong>
                <span class="block sm:inline">Un momento por favor...</span>

            </div>
            @if ($imagen)
                <img src="{{ $imagen->temporaryUrl() }}" class="mb-4">
            @else
                <img src="{{ Storage::url($post->imagen) }}">
            @endif

            <div class="mb-4">
                <x-jet-label value="Título del Post" />
                <x-jet-input wire:model="post.titulo" type="text" class="w-full" />
            </div>

            <div>
                <x-jet-label value="Contenido del Post" />
                <textarea wire:model="post.contenido" rows="6" class="form-control w-full"> </textarea>
            </div>

            <div>
                <input type="file" wire:model="imagen" id="{{ $identificador }}">

                <x-jet-input-error for="imagen" />

            </div>

        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar Post
            </x-jet-danger-button>


        </x-slot>

    </x-jet-dialog-modal>



</div>
