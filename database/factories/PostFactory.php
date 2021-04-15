<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(),
            'contenido' => $this->faker->text(),
            'imagen' => 'imgPost/' . $this->faker->image('public/storage/imgPost', 640, 480, null, false) //imgPost/imagen,
            //Concatena nombre carpeta .donde guardara las imagenes,ancho,alto,categorias,true=ruta public/storage/imgPost/img1.jpg
        ];
    }
}
