<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\UserLog;


class UserLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_belongs_to_user(){
        $user_log = UserLog::factory()->create();

        $this->assertInstanceOf("App\Models\User", $user_log->user);
    }
}
