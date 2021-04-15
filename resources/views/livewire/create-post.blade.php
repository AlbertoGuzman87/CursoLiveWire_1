<div>
    <x-jet-danger-button wire:click="$set('open',true)">
        Crear Nuevo Post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear Nuevo Post
        </x-slot>

        <x-slot name="content">
            <div wire:loading wire:target="imagen"
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">¡Imagen Cargando! </strong>
                <span class="block sm:inline">Un momento por favor...</span>

            </div>
            @if ($imagen)
                <img src="{{ $imagen->temporaryUrl() }}" class="mb-4">

            @endif



            <div class="mb-4">
                <x-jet-label value="Título del Post" />
                {{-- wire:model.defer
                Ayuda a detener la comunicación de controlador y refrescar --}}
                <x-jet-input wire:model="titulo" type="text" class="w-full" />

                <x-jet-input-error for="titulo" />

            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del Post" />
                {{-- wire:model.defer
                    Ayuda a detener la comunicación de controlador y refrescar --}}
                <textarea wire:model="contenido" name="" class="form-control w-full" rows="6"></textarea>

                <x-jet-input-error for="contenido" />

            </div>

            <div>
                <input type="file" wire:model="imagen" id="{{ $identificador }}">

                <x-jet-input-error for="imagen" />

            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save,imagen"
                class="disabled:opacity-25">
                {{-- Boton que se oculta y muestra el texto de abajo --}}
                {{-- <x-jet-danger-button wire:click="save" wire:loading.remove wire:target="save" class="disable:opacity-25"> --}}
                Crear Post
            </x-jet-danger-button>
            {{-- Texto que se muestra al dar click al boton --}}
            {{-- <span wire:loading wire:target="save">Cargando...</span> --}}
        </x-slot>

    </x-jet-dialog-modal>
</div>
