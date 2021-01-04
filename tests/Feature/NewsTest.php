<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Storage;
use Illuminate\Http\UploadedFile;

use App\Models\News;

class NewsTest extends TestCase
{
    use RefreshDatabase;
    

    public function test_an_guest_can_see_news(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $news = News::factory()->create();

        $this->get("/noticias")
            ->assertStatus(200)
            ->assertSee($news->title);
    }

    public function test_a_guest_can_see_news(){
        $news = News::factory()->create();

        $this->get("/noticias")
            ->assertStatus(200)
            ->assertSee($news->title);
    }

    public function test_an_administrator_can_search_news_by_her_title(){
        $this->signIn();

        $news = News::factory(2)->create();

        $this->get("/noticias?title=".$news[0]->title)
            ->assertStatus(200)
            ->assertSee($news[0]->title)
            ->assertDontSee($news[1]->title);
    }
    
    public function test_a_guest_can_search_news_by_her_title(){

        $news = News::factory(2)->create();

        $this->get("/noticias?title=".$news[0]->title)
            ->assertStatus(200)
            ->assertSee($news[0]->title)
            ->assertDontSee($news[1]->title);
    }

    public function test_an_administrator_can_see_a_news(){
        $this->withoutExceptionHandling();
        $this->signIn();

        $news = News::factory()->create();


        $this->get($news->path())
            ->assertStatus(200)
            ->assertSee($news->title)
            ->assertSee($news->content);
    }

    public function test_an_administrator_can_see_create_news(){
        $this->signIn();

        $this->get("/noticias/crear")
            ->assertStatus(200)
            ->assertSee("Crear publicacion");
    }

    public function test_an_administrator_can_create_a_news(){

        $this->withoutExceptionHandling();
        $this->signIn();


        $attributes = News::factory()->raw();


        $this->post("/noticias", $attributes)
            ->assertRedirect("/noticias");

        $this->get("/noticias")
            ->assertStatus(200)
            ->assertSee($attributes["title"]);

        $this->assertDatabaseHas("news",["title" => $attributes["title"]]);
    }

    public function test_an_administrator_can_create_a_news_with_image(){
        $this->signIn();

        $attributes = News::factory()->raw();

        $attributes["image"] = UploadedFile::fake()->image("news.jpg");

        $this->post("/noticias", $attributes)
            ->assertRedirect("/noticias");

        $this->get("/noticias")
            ->assertStatus(200)
            ->assertSee($attributes["title"]);

        $news = News::where("title", $attributes["title"])->first();

        Storage::disk("public")->assertExists($news->image_url);
    }

    public function test_an_administrator_can_upload_content_images(){
        $this->signIn();
        
        $attributes = [
            "file" => UploadedFile::fake()->image("post.jpg")
        ];

        $this->post("/noticias/subir-imagen", $attributes)
            ->assertStatus(200)
            ->assertJsonStructure(["location"]);
    }

    public function test_an_administrator_can_see_edit_news(){
        $this->signIn();
        $this->withoutExceptionHandling();

        $news = News::factory()->create();

        $this->get($news->path()."/editar")
            ->assertStatus(200)
            ->assertSee($news->title)
            ->assertSee($news->content);
    }

    public function test_an_administrator_can_edit_a_news(){
        $this->signIn();
        
        
        $news = News::factory()->create();

        $attributes = ["title" => "test post title"];

        $this->put($news->path(), $attributes)
            ->assertRedirect($news->path());


        $this->get("/noticias")
            ->assertStatus(200)
            ->assertSee($attributes["title"]);

        $this->assertDatabaseHas("news", ["id" => $news->id, "title" => $attributes["title"]]);
    }

    
    public function test_an_administrator_can_edit_a_news_with_image(){
        $this->signIn();

        $old_image_url = Storage::disk("public")->putFile("/news-images",UploadedFile::fake()->image("news.jpg"));

        $news = News::factory()->create(["image_url" => $old_image_url]);

        $attributes = ["image" => UploadedFile::fake()->image("news.jpg")];

        $this->put($news->path(), $attributes)
            ->assertRedirect($news->path());


        $this->get("/noticias")
            ->assertStatus(200)
            ->assertSee($news->title);

        Storage::disk("public")->assertMissing($old_image_url);
        
        $news->refresh();

        Storage::disk("public")->assertExists($news->image_url);
    }



    public function test_an_administrator_can_delete_a_news(){
        $this->signIn();

        $news = News::factory()->create();

        $this->delete($news->path())
            ->assertStatus(200);

        $this->get("/noticias")
            ->assertStatus(200)
            ->assertDontSee($news->title);

        $this->assertDatabaseMissing("news", ["title" => $news->title]);
    }

    public function test_an_administrator_can_delete_a_news_with_image(){

        $this->signIn();

        $old_image_url = UploadedFile::fake()->image("avatar.jpg");

        $news = News::factory()->create(["image_url" => $old_image_url]);

        $this->delete($news->path())
            ->assertStatus(200);

        $this->get("/noticias")
            ->assertStatus(200)
            ->assertDontSee($news->title);

        $this->assertDatabaseMissing("news", ["title" => $news->title]);
        
        Storage::disk("public")->assertMissing($old_image_url);

    }

    public function test_an_guest_cannot_delete_a_news(){

        $news = News::factory()->create();

        $this->delete($news->path())
            ->assertStatus(302);

        $this->get("/noticias")
            ->assertStatus(200)
            ->assertSee($news->title);

        $this->assertDatabaseHas("news", ["title" => $news->title]);
    }
}
