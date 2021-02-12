<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostInterface;

class PostRepository extends BaseRepository implements PostInterface {

    public function model()
    {
        return Post::class;
    }


}