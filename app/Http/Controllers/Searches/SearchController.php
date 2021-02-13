<?php

namespace App\Http\Controllers\Searches;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostResource;
use App\Repositories\Contracts\PostInterface;

class SearchController extends Controller
{
    protected $posts;

    public function __construct(PostInterface $posts)
    {
        $this->middleware('auth:api')->only('store');

        $this->posts = $posts;
    }
    
    public function show(Request $request) {
        $posts = $this->posts->search($request);

        return PostResource::collection($posts);
    }

}
