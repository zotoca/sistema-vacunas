<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Storage;



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

    public function test_an_administrator_can_see_a_post(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $post = Post::factory()->create();


        $this->get($post->path())
            ->assertStatus(200)
            ->assertSee($post->title)
            ->assertSee($post->content);
    }

    public function test_an_administrator_can_see_create_post(){
        $this->signIn();

        $this->get("/foro/crear")
            ->assertStatus(200)
            ->assertSee("Crear publicacion");
    }

    public function test_an_administrator_can_create_a_post(){

        $this->withoutExceptionHandling();
        $this->signIn();


        $attributes = Post::factory()->raw();


        $this->post("/foro", $attributes)
            ->assertRedirect("/foro");

        $this->get("/foro")
            ->assertStatus(200)
            ->assertSee($attributes["title"]);

        $this->assertDatabaseHas("posts",["title" => $attributes["title"]]);
    }

    public function test_an_administrator_can_create_a_post_with_image(){
        $this->signIn();

        $attributes = Post::factory()->raw();

        $attributes["image"] = UploadedFile::fake()->image("post.jpg");

        $this->post("/foro", $attributes)
            ->assertRedirect("/foro");

        $this->get("/foro")
            ->assertStatus(200)
            ->assertSee($attributes["title"]);

        $post = Post::where("title", $attributes["title"])->first();

        Storage::disk("public")->assertExists($post->image_url);
    }

    public function test_an_administrator_can_upload_content_images(){
        $this->signIn();
        
        $attributes = [
            "file" => UploadedFile::fake()->image("post.jpg")
        ];

        $this->post("/foro/subir-imagen", $attributes)
            ->assertStatus(200)
            ->assertJsonStructure(["location"]);
    }

    public function test_an_administrator_can_see_edit_post(){
        $this->signIn();
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $this->get($post->path()."/editar")
            ->assertStatus(200)
            ->assertSee($post->title)
            ->assertSee($post->content);
    }

    public function test_an_administrator_can_edit_a_post(){
        $this->signIn();
        
        
        $post = Post::factory()->create();

        $attributes = ["title" => "test post title"];

        $this->put($post->path(), $attributes)
            ->assertRedirect($post->path());


        $this->get("/foro")
            ->assertStatus(200)
            ->assertSee($attributes["title"]);

        $this->assertDatabaseHas("posts", ["id" => $post->id, "title" => $attributes["title"]]);
    }

    
    public function test_an_administrator_can_edit_a_post_with_image(){
        $this->signIn();

        $old_image_url = Storage::disk("public")->putFile("/post-images",UploadedFile::fake()->image("post.jpg"));

        $post = Post::factory()->create(["image_url" => $old_image_url]);

        $attributes = ["image" => UploadedFile::fake()->image("post.jpg")];

        $this->put($post->path(), $attributes)
            ->assertRedirect($post->path());


        $this->get("/foro")
            ->assertStatus(200)
            ->assertSee($post->title);

        Storage::disk("public")->assertMissing($old_image_url);
        
        $post->refresh();

        Storage::disk("public")->assertExists($post->image_url);
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
