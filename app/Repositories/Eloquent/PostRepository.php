<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostInterface;
use Illuminate\Http\Request;

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

    public function search(Request $request) {
        $query = (new $this->model)->newQuery();

        //return only the published posts
        $query->where('is_live', true);

        //return only the posts that have comments
        if ($request->has_comments) {
            $query->has('comments');
        }

        //search by title and body for provided string
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->q.'%')
                  ->orWhere('body', 'like', '%'.$request->q.'%');
            });
        }

        //Oorder by likes or latest first
        if ($request->orderBy='likes') {
            $query->withCount('likes')
                ->OrderByDesc('likes_count');
        } else {
            $query->latest();
        }
        
        return $query->get();
    }

}