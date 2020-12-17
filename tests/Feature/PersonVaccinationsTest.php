<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\PersonVaccination;
use App\Models\Vaccination;
use App\Models\Person;

class PersonVaccinationsTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_a_administrator_can_search_a_person_vaccination_by_her_vaccination_date(){

        $this->signIn();

        $person = Person::factory()->create();


        $person_vaccinations = PersonVaccination::factory(2)->create(["person_id" => $person->id]);


        $this->get($person->path(). "/vacunas-personas?vaccination-date=".$person_vaccinations[0]->vaccination_date)
            ->assertStatus(200)
            ->assertSee($person_vaccinations[0]->vaccination_date)
            ->assertDontSee($person_vaccinations[1]->vaccination_date);
    }

    public function test_a_administrator_can_see_a_person_vaccination_list_of_a_person(){
        $this->withoutExceptionHandling();

        $this->signIn();

        $person_vaccination = PersonVaccination::factory()->create();

        $person = $person_vaccination->person;

        $this->get($person->path(). "/vacunas-personas")
            ->assertStatus(200)
            ->assertSee($person_vaccination->vaccination_date);
    }

    


    public function test_a_administrator_can_search_a_person_vaccination_by_her_vaccination_id(){

        $this->signIn();

        $person = Person::factory()->create();

        $person_vaccinations = PersonVaccination::factory(2)->create(["person_id" => $person->id]);


        $this->get($person->path(). "/vacunas-personas?vaccination-id=".$person_vaccinations[0]->vaccination_id)
            ->assertStatus(200)
            ->assertSee($person_vaccinations[0]->dose)
            ->assertDontSee($person_vaccinations[1]->dose);
    }

    public function test_a_administrator_can_search_a_person_vaccination_by_her_dose(){

        $this->signIn();

        $person = Person::factory()->create();
        
        $person_vaccinations = PersonVaccination::factory(2)->create(["person_id" => $person->id]);

        $this->get($person->path(). "/vacunas-personas?dose=".$person_vaccinations[0]->dose)
            ->assertStatus(200)
            ->assertSee($person_vaccinations[0]->dose)
            ->assertDontSee($person_vaccinations[1]->dose);
    }

    public function test_a_administrator_can_search_a_person_vaccination_if_is_vaccinated(){

        $this->signIn();

        $person = Person::factory()->create();

        $person_vaccination_vaccinated = PersonVaccination::factory()->create(["person_id" => $person->id, "is_vaccinated" => true]);
        $person_vaccination_not_vaccinated = PersonVaccination::factory()->create(["person_id" => $person->id]);

        $this->get($person->path(). "/vacunas-personas?is-vaccinated=1")
            ->assertStatus(200)
            ->assertSee($person_vaccination_vaccinated->dose)
            ->assertDontSee($person_vaccination_not_vaccinated->dose);
    }

    



    public function test_an_administrator_can_create_a_person_vaccination(){

        
        $this->signIn();

        $attributes = PersonVaccination::factory()->raw();

        $this->withoutExceptionHandling();

        $this->post("/api/vacunas-personas",$attributes)
            ->assertStatus(200)
            ->assertJson(["message" => "ok"]);
        
        $person = Person::findOrFail($attributes["person_id"]);

        $this->get($person->path()."/vacunas-personas")
            ->assertStatus(200)
            ->assertSee($attributes["vaccination_date"]);
        
        $this->assertDatabaseHas("person_vaccination", ["vaccination_id" => $attributes["vaccination_id"]]);
    }


    

    public function test_a_person_vaccination_require_her_obligatories_attributes(){
        $this->signIn();

        $attributes = PersonVaccination::factory()->raw(["vaccination_id" => "","person_id" => "","vaccination_date" => "", "dose" => ""]);

        $this->post("/api/vacunas-personas", $attributes)
            ->assertStatus(302)
            ->assertSessionHasErrors("vaccination_id")
            ->assertSessionHasErrors("person_id")
            ->assertSessionHasErrors("vaccination_date");

       
        $this->assertDatabaseMissing("person_vaccination", ["vaccination_id" => $attributes["vaccination_id"]]);
    }

    public function test_an_administrator_can_edit_a_person_vaccination(){

        $this->signIn();

        
        $person_vaccination = PersonVaccination::factory()->create();
        $person = $person_vaccination->person;

        $vaccination = Vaccination::factory()->create();

        
        $attributes = ["dose" => "dose test"];
        
        $this->put("/api".$person_vaccination->path(), $attributes)
            ->assertStatus(200)
            ->assertJson(["message" => "ok"]);
        

        $this->get($person->path()."/vacunas-personas")
            ->assertStatus(200)
            ->assertSee($attributes["dose"]);
        
        
        $this->assertDatabaseHas("person_vaccination", ["id" => $person_vaccination->id, "dose" => $attributes["dose"]]);
    }

    public function test_an_administrator_can_delete_a_person_vaccination(){

        $this->signIn();

        $person_vaccination = PersonVaccination::factory()->create();
        $person = $person_vaccination->person;


        $this->delete("/api" . $person_vaccination->path())
            ->assertStatus(200)
            ->assertJson(["message" => "ok"]);
       
        $this->get($person->path()."/vacunas-personas")
        ->assertStatus(200)
        ->assertDontSee($person_vaccination->dose);

        $this->assertDatabaseMissing("person_vaccination", ["id" => $person_vaccination->id]);
    }
}
