<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostResource;
use App\Models\Post;
use App\Repositories\Contracts\PostInterface;
use App\Repositories\Eloquent\Criteria\isLive;

class PostBySlugController extends Controller
{
    protected $posts;

    public function __construct(PostInterface $posts)
    {
        $this->middleware('auth:api')->only('store');

        $this->posts = $posts;
    }

    public function show($slug)
    {
        $post = $this->posts->withCriteria([
            new isLive,
        ])->findWhereFirst('slug', $slug);

        return new PostResource($post);
    }
}
