<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Vaccination;

class VaccinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vaccination::factory(10)->create();
    }
}
