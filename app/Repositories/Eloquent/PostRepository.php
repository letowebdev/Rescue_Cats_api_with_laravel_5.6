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

    public function like($id) {

        $post = $this->find($id);

        if($post->isLikedByUser(auth()->id())) {
            $post->unlike();
        } else {
            $post->like();
        }
    }

    public function wasLikedByUser($id) {
        $post = $this->model->find($id);

        //isLikedByUser is the method we have created on our likeable trait
        return $post->isLikedByUser(auth()->id());
    }

}