<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signInAsAdministrator($user = null){
        $this->seed(PermissionSeeder::class);

        $user = $user ? : User::factory()->create()->assignRole("Super admin");

        $this->actingAs($user);
    }

    
    public function signIn($user = null){
        $this->seed(PermissionSeeder::class);
        $this->actingAs($user ? : User::factory()->create());
    }
}
