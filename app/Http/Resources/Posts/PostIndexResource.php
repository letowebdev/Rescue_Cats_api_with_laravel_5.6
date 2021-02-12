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
            'images' => $this->images,
            'is_live' => $this->is_live,
            'upload_successful' => $this->upload_successful,
            'tag_list' => [
                'tags' => $this->tagArray,
                'normalized' => $this->tagArraynormalized,
            ]
        ];
    }
}
