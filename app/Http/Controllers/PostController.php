<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

use App\Models\Post;


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


    public function destroy(Post $post){
        $post->delete();

        return response()->json(["message" => "ok"]);
    }
}
