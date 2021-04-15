<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
//Para subir imagenes
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $open = false;

    public $titulo, $contenido, $imagen, $identificador;

    public function mount()
    {
        $this->identificador= rand();
    }


    protected $rules = [
        'titulo' => 'required',
        'contenido' => 'required',
        'imagen' => 'required|image|max:2048',
    ];

    //Método que rendiriza en tiempo real
    // public function updated($nombrePropiedad)
    // {
    //     $this->validateOnly($nombrePropiedad);
    // }

    public function save()
    {
        $this->validate();
        //Guarda la img dentro de la carpeta
        $imagen = $this->imagen->store('imgPost');


        Post::create([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'imagen' => $imagen
        ]);


        //Cierra la alerta y resetea los inputs
        $this->reset(['open', 'titulo', 'contenido', 'imagen']);

        $this->identificador=rand();
        //Evento que hace refrescar la tabla
        // $this->emit('refresca');
        //Evento que hace refrescar la tabla unicamente al controlador especifico
        $this->emitTo('show-post', 'refresca');

        $this->emit('alert', 'El post se genero satisfactoriamente');
    }
    public function render()
    {
        return view('livewire.create-post');
    }
}
