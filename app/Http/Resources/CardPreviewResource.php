<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardPreviewResource extends JsonResource
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
            'zh_name' => $this->zh_name,
            'en_name' => $this->en_name,
            'cover_url' => $this->cover_url,
        ];
    }
}
