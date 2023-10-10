<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscribeResource extends JsonResource
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
            'subscribe_id' => $this->user->id,
            'subscribe_name' => $this->user->name,
        ];
    }
}
