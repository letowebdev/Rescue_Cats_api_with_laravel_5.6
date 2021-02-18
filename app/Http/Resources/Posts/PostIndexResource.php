<?php

namespace App\Http\Resources\Posts;

use App\Http\Resources\Comments\CommentResource;
use App\Http\Resources\Users\PrivateUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'body' => $this->body,
            'images' => $this->images,
            'is_live' => $this->is_live,
            'likes_count' => $this->likes()->count(),
            'upload_successful' => $this->upload_successful,
            'created_at' => $this->created_at->diffForHumans(),
            'tag_list' => [
                'tags' => $this->tagArray,
                'normalized' => $this->tagArraynormalized,
            ],
            'user' => new PrivateUserResource($this->user),
            'comments_count' => CommentResource::collection($this->comments)->count()
        ];
    }
}
