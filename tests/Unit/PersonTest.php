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

        $this->assertEquals("/persona/$person->id", $person->path());
    }

    public function test_it_belongs_to_a_house(){
        $person = Person::factory()->create();

        $this->assertInstanceOf("App\Models\House", $person->house);
    }

}
