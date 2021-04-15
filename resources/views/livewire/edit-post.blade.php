<div>
    <a class="btn btn-green" wire:click="$set('open',true)">
        <i class="fas fa-edit"></i>
    </a>


    <x-jet-dialog-modal wire:model="open">
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
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar Post
            </x-jet-danger-button>


        </x-slot>

    </x-jet-dialog-modal>



</div>
