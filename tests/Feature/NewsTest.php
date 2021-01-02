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
