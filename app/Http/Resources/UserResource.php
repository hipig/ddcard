<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'avatar' => $this->avatar,
            'is_vip' => $this->is_vip,
            'vip_expired_at' => $this->vip_expired_at->format('Y-m-d H:i:s'),
        ];
    }
}
