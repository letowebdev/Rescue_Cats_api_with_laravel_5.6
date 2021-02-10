<?php

namespace App\Http\Controllers\Comments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostResource;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Post $post)
    {
        $post->addComment(([
            'user_id' => auth()->user()->id,
            'body' => request('body')
            ]));

        return new PostResource($post);
    }
}
