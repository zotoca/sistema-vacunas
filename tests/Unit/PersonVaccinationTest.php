<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\PersonVaccination;

class PersonVaccinationTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_belongs_to_a_person(){
        $person_vaccination = PersonVaccination::factory()->create();

        $this->assertInstanceOf("App\Models\Person", $person_vaccination->person);
    }

    public function test_to_it_belongs_to_a_vaccination(){
        $person_vaccination = PersonVaccination::factory()->create();

        $this->assertInstanceOf("App\Models\Vaccination", $person_vaccination->vaccination);
    }
}
