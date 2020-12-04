<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Street;

class StreetsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_cannot_manage_streets(){
        

        $this->get("/calles")
            ->assertRedirect("/iniciar-sesion");

        $this->post("/calles")
            ->assertRedirect("/iniciar-sesion");

        $this->put("/calles/1")
            ->assertRedirect("/iniciar-sesion");

        $this->delete("/calles/1")
            ->assertRedirect("/iniciar-sesion");

    }

    public function test_a_administrator_can_see_streets(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $street = Street::factory()->create();

        $this->get("/calles")
            ->assertStatus(200)
            ->assertSee($street->name);
    }

    public function test_a_administrator_can_search_streets_by_her_name(){
        $this->signIn();

        $streets = Street::factory(2)->create();

        $this->get("/calles?name=".$streets[0]->name)
            ->assertStatus(200)
            ->assertSee($streets[0]->name)
            ->assertDontSee($streets[1]->name);
    }


    public function test_a_administrator_can_create_a_street(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $attributes = Street::factory()->raw();

        $this->post("/calles", $attributes)
            ->assertStatus(200);

        $this->get("/calles")
            ->assertStatus(200)
            ->assertSee($attributes["name"]);

        $this->assertDatabaseHas("streets", ["name" => $attributes["name"]]);
    }

    public function test_a_street_requires_a_name(){

        $this->signIn();

        $attributes = Street::factory()->raw(["name" => ""]);

        $this->post("/calles", $attributes)->assertSessionHasErrors("name");


        $this->assertDatabaseMissing("streets", ["name" => $attributes["name"]]);
    }

    public function test_a_administrator_can_update_a_street(){

        $this->withoutExceptionHandling();

        $this->signIn();


        $street = Street::factory()->create();

        $attributes = [
            "name" => "street test"
        ];

        $this->put($street->path(), $attributes)
            ->assertStatus(200);

        $this->get("/calles")
            ->assertStatus(200)
            ->assertSee("street test");
        
        $this->assertDatabaseHas("streets",["id" => $street->id, "name" => "street test"]);
    }

    public function test_a_administrator_can_delete_a_street(){


        $this->signIn();

        $street = Street::factory()->create();

        $this->delete($street->path())
            ->assertStatus(200);

        $this->get("/calles")
            ->assertStatus(200)
            ->assertDontSee($street->name);
        
        
        $this->assertDatabaseMissing("streets", ["name" => $street->name]);
    }



}
