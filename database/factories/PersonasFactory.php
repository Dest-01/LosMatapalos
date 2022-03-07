<?php

namespace Database\Factories;

use App\Models\Personas;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PersonasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Personas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'apellido1' => $this->faker->lastName,
            'apellido2' => $this->faker->lastName,
            'correo' => $this->faker->unique()->safeEmail,
            'identificacion' => $this->faker->randomNumber(),
            'telefono' => $this->faker->randomNumber(),
        ];
    }
}
