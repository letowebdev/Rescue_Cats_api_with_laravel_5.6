<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class PrivateUserResource extends JsonResource
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
            'name' => $this->name,
            'tagline' => $this->tagline,
            'image_url' => $this->imageUrl,
            'username' => $this->username,
            'email' => $this->email,
            'about' => $this->about,
            'formatted_address' => $this->formatted_address,
            'available_to_volunteer' => $this->available_to_volunteer,
        ];
    }
}
