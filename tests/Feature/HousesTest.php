<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\House;
use App\Models\Street;

class HousesTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_a_guest_cannot_manage_houses(){
        
        

        $this->get("/calles/1/casas")
            ->assertRedirect("/iniciar-sesion");

        $this->post("/casas")
            ->assertRedirect("/iniciar-sesion");

        $this->put("/casas/1")
            ->assertRedirect("/iniciar-sesion");

        $this->delete("/casas/1")
            ->assertRedirect("/iniciar-sesion");
    }

    public function test_a_administrator_can_see_houses(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $house = House::factory()->create();
        $street = $house->street;
        $this->get("/calles/$street->id/casas")
            ->assertStatus(200)
            ->assertSee($house->number);
    }

    public function test_a_administrator_can_search_houses_by_her_number(){
        $this->signIn();

        $street = Street::factory()->create();
        $houses = [];
        
        $houses = [
            House::factory()->create(["number" => 888888,"street_id" => $street->id]),
            House::factory()->create(["number" => 111111,"street_id" => $street->id]) 
        ];


        $this->get("/calles/$street->id/casas?number=".$houses[0]->number)
            ->assertStatus(200)
            ->assertSee($houses[0]->number)
            ->assertDontSee($houses[1]->number);
    }


    public function test_a_administrator_can_create_a_house(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $attributes = House::factory()->raw();

        

        $this->post("/casas", $attributes)
            ->assertStatus(200);

        $street_id = $attributes["street_id"];

        $this->get("/calles/$street_id/casas")
            ->assertStatus(200)
            ->assertSee($attributes["number"]);

        $this->assertDatabaseHas("houses", ["number" => $attributes["number"]]);
    }

    public function test_a_house_requires_a_number(){

        $this->signIn();

        $attributes = House::factory()->raw(["number" => ""]);

        $this->post("/casas", $attributes)->assertSessionHasErrors("number");


        $this->assertDatabaseMissing("houses", ["number" => $attributes["number"]]);
    }

    public function test_a_house_requires_a_street_id(){

        $this->signIn();

        $attributes = House::factory()->raw(["street_id" => ""]);

        $this->post("/casas", $attributes)->assertSessionHasErrors("street_id");


        $this->assertDatabaseMissing("houses", ["number" => $attributes["number"]]);
    }


    public function test_a_administrator_can_update_a_house(){

        $this->withoutExceptionHandling();

        $this->signIn();


        $house = House::factory()->create();
        $street = $house->street;

        $attributes = [
            "number" => 3
        ];

        $this->put($house->path(), $attributes)
            ->assertStatus(200);

        $this->get("/calles/$street->id/casas")
            ->assertStatus(200)
            ->assertSee("3");
        
        $this->assertDatabaseHas("houses",["id" => $house->id, "number" => 3]);
    }

    public function test_a_administrator_can_delete_a_house(){

        $this->signIn();

        $house = House::factory()->create();
        $street = $house->street;

        $this->delete($house->path())
            ->assertStatus(200);

        $this->get("/calles/$street->id/casas")
            ->assertStatus(200)
            ->assertDontSee($house->number);
        
        
        $this->assertDatabaseMissing("houses", ["number" => $house->number]);
    }



}
