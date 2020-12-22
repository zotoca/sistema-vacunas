<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class AdministratorsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_administrator_can_see_persons(){
        
        $this->signIn();

        $user = User::factory()->create();

        $this->get("/administradores")
            ->assertStatus(200)
            ->assertSee($user->first_name);
    }

    public function test_a_administrator_can_search_administrators_by_her_first_name(){


        $this->signIn();

        $users = User::factory(2)->create();

        $this->get("/administradores?first-name=" . $users[0]->first_name)
        ->assertSee($users[0]->first_name)
        ->assertDontSee($users[1]->first_name);
 
    }

    public function test_a_administrator_can_search_administrators_by_her_last_name(){


        $this->signIn();

        $users = User::factory(2)->create();

        $this->get("/administradores?last-name=" . $users[0]->last_name)
        ->assertSee($users[0]->last_name)
        ->assertDontSee($users[1]->last_name);

    }

    
}
