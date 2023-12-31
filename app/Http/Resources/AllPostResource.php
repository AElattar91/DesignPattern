<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\api\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AllPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
     public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,  
            'slug' => $this->slug, 
                'title' => $this->title,  
                'description' => $this->description,
                'image'  => $this->getFirstMediaUrl('posts'),
                'User' => UserResource::make($this->User), 
  
        ];
    }
}
