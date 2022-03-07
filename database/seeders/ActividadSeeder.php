<?php

namespace Database\Seeders;
use App\Models\Actividades;
use Illuminate\Database\Seeder;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actividades::factory()
            ->count(1)
            ->create();
    }
}
