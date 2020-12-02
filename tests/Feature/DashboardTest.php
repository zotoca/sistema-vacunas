<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Person;

class DashboardTest extends TestCase
{
    use RefreshDatabase;
    

    public function test_a_administrator_see_dashboard(){
        


        $this->signIn();

        $persons = Person::factory(10)->create();


        $this->get("/panel")
            ->assertStatus(200)
            ->assertSee("1 Administradores")
            ->assertSee("10 Personas")
            ->assertSee("10 Casas")
            ->assertSee("10 Calles");
    }



}
