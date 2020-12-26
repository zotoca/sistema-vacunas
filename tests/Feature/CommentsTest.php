<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Comment;
use App\Models\Post;

class CommentsTest extends TestCase
{

    use RefreshDatabase;

    public function test_an_administrator_can_create_an_comment(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $attributes = Comment::factory()->raw();

        $post = Post::findOrFail($attributes["post_id"]);

        $this->post("/comentarios" , $attributes)
            ->assertRedirect($post->path());

        $this->get($post->path())
            ->assertStatus(200)
            ->assertSee($attributes["content"]);

        $this->assertDatabaseHas("comments", ["content" => $attributes["content"]]);
    }

    public function test_an_administrator_can_update_an_comment(){

        $this->signIn();

        $comment = Comment::factory()->create();

        $post = $comment->post;

        $attributes = ["content" => "comment content test"];

        $this->put($comment->path(), $attributes)
            ->assertStatus(200);

        $this->get($post->path())
            ->assertStatus(200)
            ->assertSee($attributes["content"]);

        $this->assertDatabaseHas("comments", ["id" => $comment->id, "content" => $attributes["content"]]);
    }

    public function test_an_administrator_can_delete_an_comment(){
        $this->signIn();

        $comment = Comment::factory()->create();

        $post = $comment->post;

        $this->delete($comment->path())
            ->assertStatus(200);

        $this->get($post->path())
            ->assertStatus(200)
            ->assertDontSee($comment->content);

        $this->assertDatabaseMissing("comments", ["id" => $comment->id]);
    }

}
