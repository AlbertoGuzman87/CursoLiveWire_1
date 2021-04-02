<div>
    <x-jet-danger-button wire:click="$set('open',true)">
        Crear Nuevo Post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear Nuevo Post
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Título del Post" />
                {{-- wire:model.defer
                Ayuda a detener la comunicación de controlador y refrescar --}}
                <x-jet-input wire:model.defer="titulo" type="text" class="w-full" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del Post" />
                {{-- wire:model.defer
                    Ayuda a detener la comunicación de controlador y refrescar --}}
                <textarea wire:model.defer="contenido" name="" class="form-control w-full" rows="6"></textarea>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save">
                Crear Post
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

</div>
