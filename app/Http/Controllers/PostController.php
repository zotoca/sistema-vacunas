<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Storage;

use App\Models\Post;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
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


    public function show(Request $request, Post $post){

        return View::make("posts.post-show", ["post" => $post]);
    }

    public function create(Request $request){

        return View::make("posts.post-create");
    }

    public function store(PostCreateRequest $request){
        $validated = $request->validated();


        if(isset($validated["image"])){
            $validated["image_url"] = Storage::disk("public")->putFile("/post-images", $request->file("image"));
        }
        else{
            $validated["image_url"] = "foro.jpg";
        }
        $validated["user_id"] = auth()->user()->id;
        Post::create($validated);

        return redirect("/foro");
    }

    public function edit(Post $post){

        return View::make("posts.post-edit",["post" => $post]);

    }

    public function update(PostUpdateRequest $request,Post $post){
        $validated = $request->validated();

        array_filter($validated);

        if(isset($validated["image"])){
            if($post->image_url != "foro.jpg"){
                Storage::disk("public")->delete($post->image_url);
            }
            $validated["image_url"] = Storage::disk("public")->putFile("/post-images", $validated["image"]);
        }

        $post->update($validated);

        return redirect($post->path());

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
