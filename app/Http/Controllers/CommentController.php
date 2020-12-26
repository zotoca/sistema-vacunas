<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;

use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentUpdateRequest;


class CommentController extends Controller
{
    

    public function store(CommentCreateRequest $request){
        $validated = $request->validated();

        $validated["user_id"] = auth()->user()->id;

        $comment = Comment::create($validated);

        return redirect($comment->post->path());

    }

    public function update(CommentUpdateRequest $request, Comment $comment){
        $validated = $request->validated();

        $comment->update($validated);

        return response()->json(["message" => "ok"]);



    }

    public function destroy(Comment $comment){

        $comment->delete();

        return response()->json(["message" => "ok"]);

    }


}
