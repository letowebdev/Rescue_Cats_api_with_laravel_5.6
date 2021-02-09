<?php

namespace App\Http\Resources\Posts;

use App\Http\Resources\Comments\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends PostIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'comments' => CommentResource::collection($this->comments)
        ]);
    }
}
