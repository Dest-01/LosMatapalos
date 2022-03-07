<?php

namespace Database\Factories;

use App\Models\actividades;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ActividadesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = actividades::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'fecha' => $this->faker->dateTime(),
            'hora' => $this->faker->time(),
            'descripcion' => $this->faker->sentence,
            'cantParticipantes' => $this->faker->randomNumber(2),
            'imagen' => '/images/actividad.jpg.jpg',
            'tipo' => $this->faker->name
        ];
    }
}
