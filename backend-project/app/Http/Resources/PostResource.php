<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'name'=>$this->name,
            'detail'=>$this->detail,
            'image_path'=>$this->image_path,
            'user_id'=>$this->user->id,
            'user_name' => $this->user->name,
            'user_email' => $this->user->email,
            'user_profile_image' =>$this->user->profile_image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
