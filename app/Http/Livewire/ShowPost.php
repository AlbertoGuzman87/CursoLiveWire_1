<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

//Para subir imagenes
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
//Paginación
use Livewire\WithPagination;

class ShowPost extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $ordenanaBy = 'id';
    public $direction = 'desc';
    //Variable para mostrar la cantidad de registros a mostrar
    public $cantidad = '10';

    //queryString es para que viaje por la URL en caso de compartir ese link
    //except para que no se muestre todas las variables con los valores definidos
    protected $queryString = [
        'cantidad'  => ['except' => '10'],
        'ordenanaBy' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search'    => ['except' => ''],
    ];

    public $post, $imagen, $identificador;
    public $open_edit = false;
    protected $rules = [
        'post.titulo' => 'required',
        'post.contenido' => 'required',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount()
    {
        $this->identificador = rand();
        $this->post = new Post();
    }

    public function update()
    {
        $this->validate();

        if ($this->imagen) {
            //Elimina la imagen asociada a ese post
            Storage::delete([$this->post->imagen]);
            //Guarda la nueva img dentro de la carpeta y la ruta
            $this->post->imagen = $this->imagen->store('imgPost');
        }

        $this->post->save();
        $this->reset(['open_edit', 'imagen']);
        $this->identificador = rand();
        $this->emit('alert', 'El post se actualizo satisfactoriamente');
    }


    //arreglo que escucha el evento refresca
    protected $listeners = ['refresca' => 'render'];

    public function render()
    {
        $lisPost = Post::where('titulo', 'like', '%' . $this->search . '%')
            ->Orwhere('contenido', 'like', '%' . $this->search . '%')
            ->orderBy($this->ordenanaBy, $this->direction)
            ->paginate($this->cantidad);

        return view('livewire.show-post', compact('lisPost'));
    }

    public function ordenar($ordenaBy)
    {
        if ($this->ordenanaBy == $ordenaBy) {
            if ($this->direction == 'asc') {
                $this->direction = "desc";
            } else {
                $this->direction = "asc";
            }
        } else {
            $this->ordenanaBy = $ordenaBy;
            $this->direction = "asc";
        }
    }

    public function edit(Post $post)
    {
        $this->post = $post;
        $this->open_edit = true;
    }
}
