<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Person;

class DashboardTest extends TestCase
{
    use RefreshDatabase;
    

    public function test_a_guest_cannot_see_dashboard(){
        $this->get("/panel")
            ->assertRedirect("/iniciar-sesion");

    }

    public function test_a_administrator_cannot_see_home(){
        $this->signIn();

        $this->get("/")
            ->assertRedirect("/panel");
    }

    public function test_a_administrator_see_dashboard(){
        
        $this->withoutExceptionHandling();

        $this->signIn();

        $persons = Person::factory(10)->create();


        $this->get("/panel")
            ->assertStatus(200)
            ->assertSee("1")
            ->assertSee("10");
    }



}
