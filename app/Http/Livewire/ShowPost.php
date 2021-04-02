<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public $search;
    public $ordenanaBy = 'id';
    public $direction = 'asc';

    //arreglo que escucha el evento refresca
    protected $listeners = ['refresca' => 'render'];

    public function render()
    {
        $lisPost = Post::where('titulo', 'like', '%' . $this->search . '%')
            ->Orwhere('contenido', 'like', '%' . $this->search . '%')
            ->orderBy($this->ordenanaBy, $this->direction)
            ->get();

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
}
