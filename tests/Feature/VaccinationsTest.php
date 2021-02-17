<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Vaccination;
use App\Models\User;
class VaccinationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_cannot_manage_vaccination(){
        

        $this->get("/vacunas")
            ->assertRedirect("/iniciar-sesion");

        $this->post("/vacunas")
            ->assertRedirect("/iniciar-sesion");

        $this->put("/vacunas/1")
            ->assertRedirect("/iniciar-sesion");

        //$this->delete("/vacunas/1")
        //    ->assertRedirect("/iniciar-sesion");

    }

    public function test_a_administrator_can_see_vaccination(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $vaccination = Vaccination::factory()->create();

        $this->get("/vacunas")
            ->assertStatus(200)
            ->assertSee($vaccination->name);
    }

    public function test_a_administrator_can_search_vaccinations_by_her_name(){
        $this->signIn();

        $vaccinations = Vaccination::factory(2)->create();

        $this->get("/vacunas?name=".$vaccinations[0]->name)
            ->assertStatus(200)
            ->assertSee($vaccinations[0]->name)
            ->assertDontSee($vaccinations[1]->name);
    }


    public function test_a_administrator_can_create_a_vaccination(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $attributes = Vaccination::factory()->raw();

        $this->post("/vacunas", $attributes)
            ->assertStatus(200);

        $this->get("/vacunas")
            ->assertStatus(200)
            ->assertSee($attributes["name"]);

        $this->assertDatabaseHas("vaccinations", ["name" => $attributes["name"]]);
    }

    public function test_a_vaccination_requires_a_name(){

        $this->signIn();

        $attributes = Vaccination::factory()->raw(["name" => ""]);

        $this->post("/vacunas", $attributes)->assertSessionHasErrors("name");


        $this->assertDatabaseMissing("vaccinations", ["name" => $attributes["name"]]);
    }

    public function test_a_administrator_can_update_a_vaccination(){

        $this->withoutExceptionHandling();

        $this->signIn();


        $vaccination = Vaccination::factory()->create();

        $attributes = [
            "name" => "vaccination test"
        ];

        $this->put($vaccination->path(), $attributes)
            ->assertStatus(200);

        $this->get("/vacunas")
            ->assertStatus(200)
            ->assertSee("vaccination test");
        
        $this->assertDatabaseHas("vaccinations",["id" => $vaccination->id, "name" => "vaccination test"]);
    }

    //public function test_a_administrator_can_delete_a_vaccination(){
    //    $this->withoutExceptionHandling();

    //    $user = User::factory()->create(["password" => "Secret123."]);
        
    //    $this->signIn($user);

    //    $vaccination = Vaccination::factory()->create();

    //    $password = auth()->user()->password;

    //    $this->post($vaccination->path()."/eliminar",["password" => "Secret123."])
    //        ->assertStatus(200);

    //    $this->get("/vacunas")
    //        ->assertStatus(200)
    //        ->assertDontSee($vaccination->name);
        
        
    //    $this->assertDatabaseMissing("vaccinations", ["name" => $vaccination->name]);
    //}

    //public function test_an_administrator_cannot_delete_a_vaccination_with_wrong_password(){
        

    //    $this->signIn();

    //    $vaccination = Vaccination::factory()->create();

    //    $this->post($vaccination->path()."/eliminar")
    //        ->assertStatus(302);

    //    $this->get("/vacunas")
    //        ->assertStatus(200)
    //        ->assertSee($vaccination->name);
        
        
    //    $this->assertDatabaseHas("vaccinations", ["name" => $vaccination->name]);


    //}
    public function test_an_administrator_can_get_vaccinations_api(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $vaccination = Vaccination::factory()->create();
        
        $this->get("/api/vacunas")
            ->assertStatus(200)
            ->assertJsonStructure([["id", "name", "created_at", "updated_at"]]);
    }

}
