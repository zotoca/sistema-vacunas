<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


use App\Models\Person;

class PersonTest extends TestCase
{
    use RefreshDatabase;


    public function test_it_has_a_path(){
        $person = Person::factory()->create();

        $this->assertEquals("/personas/$person->id", $person->path());
    }

    public function test_it_belongs_to_a_house(){
        $person = Person::factory()->create();

        $this->assertInstanceOf("App\Models\House", $person->house);
    }

    public function test_it_has_full_name(){

        $person = Person::factory()->create();

        $full_name = $person->first_name . " " . $person->last_name;

        $this->assertEquals($full_name, $person->fullName);
    }

    public function test_it_belongs_to_a_father_and_a_mother(){
        $parents = Person::factory(2)->create();
        

        $person = Person::factory()->create(["father_id" => $parents[0]->id, "mother_id" => $parents[1]->id]);

        $this->assertInstanceOf("App\Models\Person", $person->father);
        $this->assertInstanceOf("App\Models\Person", $person->mother);
    }



}
