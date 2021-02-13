<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CommentRequest;
use App\Http\Resources\Comments\CommentResource;
use App\Http\Resources\Posts\PostResource;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Post $post, CommentRequest $request)
    {
        $post->addComment(([
            'user_id' => auth()->user()->id,
            'body' => $request->body,
            ]));

        return new PostResource($post);
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $comment->update([
            'body' => $request->body
        ]);

        return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            "message" => "Comment deleted"
        ]);
    }
}
