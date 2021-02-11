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
            'username' => $this->username,
            'email' => $this->email,
            'about' => $this->about,
            'tagline' => $this->tagline,
            'formatted_address' => $this->formatted_address,
            'location' => $this->location,
            'available_to_hire' => $this->available_to_hire,
        ];
    }
}
