<?php

namespace Tests\Unit;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path(){
        $comment = Comment::factory()->create();


        $this->assertEquals("/comentarios/$comment->id", $comment->path());
    }

    public function test_it_belongs_to_a_post(){
        $comment = Comment::factory()->create();


        $this->assertInstanceOf("App\Models\Post", $comment->post);
    }

    public function test_it_belongs_to_an_user(){
        $comment = Comment::factory()->create();


        $this->assertInstanceOf("App\Models\User", $comment->user);

    }
}
