<?php

namespace App\Http\Resources\Posts;

use App\Http\Resources\Comments\CommentResource;
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
            'image' => $this->image,
            'is_live' => $this->is_live,
            'upload_successful' => $this->upload_successful,
            'tags' => $this->tags
        ];
    }
}
