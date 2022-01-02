<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signInAsAdministrator($user = null){
        $role = Role::create(["name" => "Super admin"]);

        $user = $user ? : User::factory()->create()->assignRole("Super admin");

        $this->actingAs($user);
    }

    
    public function signIn($user = null){

        $this->actingAs($user ? : User::factory()->create());
    }
}
