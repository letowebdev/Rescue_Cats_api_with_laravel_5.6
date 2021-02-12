<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostInterface;

class PostRepository extends BaseRepository implements PostInterface {

    public function model()
    {
        return Post::class;
    }

    public function addTags($id, array $data)
    {
        $post = $this->find($id);
        $post->tag($data);
    }

    public function reTags($id, array $data)
    {
        $post = $this->find($id);
        $post->retag($data);
    }

}