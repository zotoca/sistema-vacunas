<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Http\Requests\UploadImageRequest;
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

    
    public function show(Request $request, News $news){

        return View::make("news.news-show", ["news" => $news]);
    }

    
    
    public function create(Request $request){

        return View::make("news.news-create");
    }




    public function store(NewsCreateRequest $request){
        $validated = $request->validated();


        if(isset($validated["image"])){
            $validated["image_url"] = Storage::disk("public")->putFile("/news-images", $request->file("image"));
        }     
        $validated["user_id"] = auth()->user()->id;
        News::create($validated);

        return redirect("/noticias");
    }

    
    public function edit(News $news){

        return View::make("news.news-edit",["news" => $news]);

    }
    public function update(NewsUpdateRequest $request,News $news){
        $validated = $request->validated();

        array_filter($validated);

        if(isset($validated["image"])){
            if($news->image_url != "news.jpg"){
                Storage::disk("public")->delete($news->image_url);
            }
            $validated["image_url"] = Storage::disk("public")->putFile("/news-images", $validated["image"]);
        }

        $news->update($validated);

        return redirect($news->path());

    }

    public function uploadImage(UploadImageRequest $request){
        $validated = $request->validated();

        $location = "/storage/" . Storage::disk("public")->putFile("/news-content-images",$validated["file"]);

        return response()->json(["location" => $location]);
    }

    public function destroy(News $news){
        if($news->image_url != "news-images/news.jpg"){
            Storage::disk("public")->delete($news->image_url);
        }
        
        $news->delete();


        return response()->json(["message" => "ok"]);
    }
}
