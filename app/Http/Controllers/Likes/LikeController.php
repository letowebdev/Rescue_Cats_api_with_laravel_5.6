<?php

namespace App\Http\Controllers\Likes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostInterface;

class LikeController extends Controller
{
    protected $posts;

    public function __construct(PostInterface $posts)
    {
        $this->middleware('auth:api')->only('store');

        $this->posts = $posts;
    }
    
    public function store($id) {
        $this->posts->like($id);

        return response()->json([
            "message" => "success"
        ]);
    }








}
