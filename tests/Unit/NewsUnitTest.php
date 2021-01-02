<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


use App\Models\News;



class NewsUnitTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_has_a_path(){
        $news = News::factory()->create(); 

        $this->assertEquals("/noticias/$news->id", $news->path());
    }

    public function test_it_belongs_to_a_user(){
        $news = News::factory()->create();

        $this->assertInstanceOf("App\Models\User", $news->user);
    }

    
}
