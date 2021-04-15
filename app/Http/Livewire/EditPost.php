<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
//Para subir imagenes
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{

    use WithFileUploads;

    public $open = false;

    public $post, $imagen, $identificador;

    protected $rules = [
        'post.titulo' => 'required',
        'post.contenido' => 'required',
    ];

    public function mount(Post $post_id)
    {
        $this->post = $post_id;

        $this->identificador = rand();
    }

    public function save()
    {
        $this->validate();

        if ($this->imagen) {
            //Elimina la imagen asociada a ese post
            Storage::delete([$this->post->imagen]);
            //Guarda la nueva img dentro de la carpeta y la ruta
            $this->post->imagen = $this->imagen->store('imgPost');
        }

        $this->post->save();
        $this->reset(['open', 'imagen']);
        $this->identificador = rand();
        $this->emitTo('show-post', 'refresca');
        $this->emit('alert', 'El post se actualizo satisfactoriamente');
    }
    public function render()
    {
        return view('livewire.edit-post');
    }
}
