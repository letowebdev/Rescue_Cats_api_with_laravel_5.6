<?php

namespace App\Http\Controllers\Comments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostResource;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        
        $post->addComment(([
            'user_id' => 1,
            'body' => request('body')
            ]));

        return new PostResource($post);
    }
}
