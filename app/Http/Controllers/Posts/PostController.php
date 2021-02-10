<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostRequest;
use App\Http\Resources\Posts\PostIndexResource;
use App\Http\Resources\Posts\PostResource;
use App\Models\Post;
use Faker\Generator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store');
    }
    
    public function index()
    {
        $posts = Post::paginate(5);

        return PostIndexResource::collection($posts);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function store(PostRequest $request, Generator $faker)
    {
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => $title = $request->title,
            'slug' => str_slug($title  . $faker->unique()->randomNumber),
            'body' => $request->body
        ]);

        return new PostResource($post);
    }

    public function update()
    {

    }

}
