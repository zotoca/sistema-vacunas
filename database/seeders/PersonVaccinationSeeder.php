<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Person;
use App\Models\PersonVaccination;

class PersonVaccinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = Person::factory()->create();
        PersonVaccination::factory(10)->create(["person_id" => $person->id]);
    }
}
