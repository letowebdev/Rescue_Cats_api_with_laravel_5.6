<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostIndexResource;
use App\Http\Resources\Posts\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);

        return PostIndexResource::collection($posts);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }
}
