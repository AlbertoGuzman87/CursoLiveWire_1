<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public $open = true;

    public $titulo, $contenido;

    protected $rules = [
        'titulo' => 'required',
        'contenido' => 'required',
    ];

    //Método que rendiriza en tiempo real
    // public function updated($nombrePropiedad)
    // {
    //     $this->validateOnly($nombrePropiedad);
    // }

    public function save()
    {
        $this->validate();

        Post::create([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
        ]);


        //Cierra la alerta y resetea los inputs
        $this->reset(['open', 'titulo', 'contenido']);
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
