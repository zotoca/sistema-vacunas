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


    public function test_an_administrator_can_create_a_person_vaccination(){

        
        $this->signIn();

        $attributes = PersonVaccination::factory()->raw();

        $this->withoutExceptionHandling();

        $this->post("/api/vacunas-personas",$attributes)
            ->assertStatus(200)
            ->assertJsonStructure(["id","vaccination_id","vaccination_date","dose","person_id"]);
        
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

        $vaccination = Vaccination::factory()->create();

        
        $attributes = ["vaccination_id" => $vaccination->id];
        
        $this->put("/api".$person_vaccination->path(), $attributes)
            ->assertStatus(200)
            ->assertJsonStructure(["id", "vaccination_id", "vaccination_date", "dose", "person_id"]);
        
        
        $this->assertDatabaseHas("person_vaccination", ["id" => $person_vaccination->id, "vaccination_id" => $attributes["vaccination_id"]]);
    }

    public function test_an_administrator_can_delete_a_person_vaccination(){

        $this->signIn();

        $person_vaccination = PersonVaccination::factory()->create();

        $this->delete("/api" . $person_vaccination->path())
            ->assertStatus(200)
            ->assertJson(["message" => "ok"]);

        $this->assertDatabaseMissing("person_vaccination", ["id" => $person_vaccination->id]);
    }
}
