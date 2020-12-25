<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Storage;

use App\Models\Post;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\UploadImageRequest;


class PostController extends Controller
{
    public function index(Request $request){
        $title = $request->get("title");


        $posts = Post::title($title)
            ->orderBy("created_at", "DESC")
            ->paginate(6)
            ->appends(["title" => $title]);


        return View::make("posts.post-index", ["posts" => $posts]);
    }

    public function create(Request $request){

        return View::make("posts.post-create");
    }

    public function store(PostCreateRequest $request){
        $validated = $request->validated();


        if(isset($validated["image"])){
            $validated["image_url"] = Storage::disk("public")->putFile("/posts", $request->file("image"));
        }     
        $validated["user_id"] = auth()->user()->id;
        Post::create($validated);

        return redirect("/foro");
    }


    public function destroy(Post $post){
        $post->delete();

        return response()->json(["message" => "ok"]);
    }
    
    public function uploadImage(UploadImageRequest $request){
        $validated = $request->validated();

        $location = "/storage/" . Storage::disk("public")->putFile("/content-images",$validated["file"]);

        return response()->json(["location" => $location]);
    }

}
