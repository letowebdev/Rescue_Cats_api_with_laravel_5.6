<?php

namespace App\Http\Controllers\Comments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        
        $post->addComment(request([
            // 'user_id' => Auth::user()->id,
            'body' => request('body')
            ]));

        return new PostResource($post);
    }
}
