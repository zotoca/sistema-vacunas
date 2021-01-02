<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;
use Storage;
use View;

class NewsController extends Controller
{
    public function index(Request $request){
        $title = $request->get("title");


        $news = News::title($title)
            ->orderBy("created_at", "DESC")
            ->paginate(6)
            ->appends(["title" => $title]);


        return View::make("news.news-index", ["news" => $news]);
    }

    public function destroy(News $news){
        if($news->image_url != "news-images/news.jpg"){
            Storage::disk("public")->delete($news->image_url);
        }
        
        $news->delete();


        return response()->json(["message" => "ok"]);
    }
}
