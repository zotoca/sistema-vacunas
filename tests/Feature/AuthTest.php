<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_administrator_cannot_authenticate_again(){
        $this->signIn();

        $this->get("/iniciar-sesion")
            ->assertRedirect("/panel");
    }

    public function test_a_administrator_can_logout(){
        $this->signIn();

        $this->get("/logout")
            ->assertRedirect("/");
    }
}
