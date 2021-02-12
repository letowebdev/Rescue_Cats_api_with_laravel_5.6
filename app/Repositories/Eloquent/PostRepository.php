<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostInterface;

class PostRepository implements PostInterface {


    public function all() {
        
        return Post::all();
    }

    public function paginate($value)
    {
        return Post::paginate($value);
    }

}