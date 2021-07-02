<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardGroupResource extends JsonResource
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
            'zh_name' => $this->zh_name,
            'en_name' => $this->en_name,
            'cover_url' => $this->cover_url,
            'is_lock' => $this->is_lock,
            'color' => $this->color,
            'cards' => CardResource::collection($this->whenLoaded('cards')),
        ];
    }
}
