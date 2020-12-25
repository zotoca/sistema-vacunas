<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Post;


class PostTest extends TestCase
{

    use RefreshDatabase;


    public function test_it_has_a_path(){
        $post = Post::factory()->create();

        $this->assertEquals("/foro/$post->id", $post->path());
    }

    public function test_it_belongs_to_user(){
        $post = Post::factory()->create();

        $this->assertInstanceOf("App\Models\User", $post->user);
    }


}
