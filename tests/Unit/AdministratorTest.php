<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;

class AdministratorTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path(){
        $user = User::factory()->create();

        $this->assertEquals("/administradores/$user->id", $user->path());
    }
    


}
