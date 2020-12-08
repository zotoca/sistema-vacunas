<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Person;

class PersonsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_cannot_manage_persons(){
        

        $this->get("/personas")
            ->assertRedirect("/iniciar-sesion");

        $this->post("/personas")
            ->assertRedirect("/iniciar-sesion");
        
        $this->get("/personas/1")
            ->assertRedirect("/iniciar-sesion");

        $this->put("/personas/1")
            ->assertRedirect("/iniciar-sesion");

        $this->delete("/personas/1")
            ->assertRedirect("/iniciar-sesion");

    }

    public function test_a_administrator_can_see_persons(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $person = Person::factory()->create();

        $this->get("/personas")
            ->assertStatus(200)
            ->assertSee($person->first_name);
    }

    public function test_a_administrator_can_search_persons_by_her_dni(){
        $this->signIn();

        $persons = Person::factory(2)->create();

        $this->get("/personas?dni=".$persons[0]->dni)
            ->assertStatus(200)
            ->assertSee($persons[0]->first_name)
            ->assertDontSee($persons[1]->first_name);
    
        }

    public function test_a_administrator_can_search_persons_by_missing_vaccines(){
        $this->signIn();

        $person_vaccinations = PersonVaccination::factory(2)->create();


        $this->get("/personas?missing-vaccination=".$person_vaccination[0]->vaccination_id)
            ->assertStatus(200)
            ->assertSee($person_vaccinations[0]->person->first_name)
            ->assertDontSee($person_vaccinations[1]->person->first_name);
    }
    public function test_a_administrator_can_create_a_person(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $attributes = Person::factory()->raw();

        $this->post("/personas", $attributes)
            ->assertStatus(200);

        $this->get("/personas")
            ->assertStatus(200)
            ->assertSee($attributes["first_name"]);

        $this->assertDatabaseHas("persons", ["first_name" => $attributes["first_name"]]);
    }

    public function test_a_person_requires_a_first_name(){

        $this->signIn();

        $attributes = Person::factory()->raw(["first_name" => ""]);

        $this->post("/personas", $attributes)->assertSessionHasErrors("first_name");


        $this->assertDatabaseMissing("persons", ["first_name" => $attributes["first_name"]]);
    }

    public function test_a_administrator_can_update_a_person(){

        $this->withoutExceptionHandling();

        $this->signIn();


        $person = Person::factory()->create();

        $attributes = [
            "first_name" => "person test"
        ];

        $this->put($person->path(), $attributes)
            ->assertStatus(200);

        $this->get("/personas")
            ->assertStatus(200)
            ->assertSee("person test");
        
        $this->assertDatabaseHas("persons",["id" => $person->id, "first_name" => "person test"]);
    }

    public function test_a_administrator_can_delete_a_person(){

        $this->signIn();

        $person = Person::factory()->create();

        $this->delete($person->path())
            ->assertStatus(200);

        $this->get("/personas")
            ->assertStatus(200)
            ->assertDontSee($person->first_name);
        
        
        $this->assertDatabaseMissing("persons", ["first_name" => $person->first_name]);
    }
}
