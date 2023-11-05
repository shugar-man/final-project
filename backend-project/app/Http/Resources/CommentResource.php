<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'user_id'=>$this->user->id,
            'user_name' => $this->user->name,
            'user_email' => $this->user->email,
            'post_id' => $this->post->id,
            'post_name' => $this->post->name,
            'text' => $this->text,
        ];
    }
}
