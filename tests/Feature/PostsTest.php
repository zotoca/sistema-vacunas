<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Post;

class PostsTest extends TestCase
{

    use RefreshDatabase;
    

    public function test_a_administrator_can_see_posts(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $post = Post::factory()->create();

        $this->get("/foro")
            ->assertStatus(200)
            ->assertSee($post->title);
    }

    public function test_a_administrator_can_search_posts_by_her_title(){
        $this->signIn();

        $posts = Post::factory(2)->create();

        $this->get("/foro?title=".$posts[0]->title)
            ->assertStatus(200)
            ->assertSee($posts[0]->title)
            ->assertDontSee($posts[1]->title);
    }


    public function test_an_administrator_can_delete_a_post(){
        $this->signIn();

        $post = Post::factory()->create();

        $this->delete($post->path())
            ->assertStatus(200);

        $this->get("/foro")
            ->assertStatus(200)
            ->assertDontSee($post->title);

        $this->assertDatabaseMissing("posts", ["title" => $post->title]);



    }

    


}
