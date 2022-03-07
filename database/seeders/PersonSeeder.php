<?php

namespace Database\Seeders;
use App\Models\Personas;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Personas::factory()
            ->count(5000)
            ->create();
    }
}
