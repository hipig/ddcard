<?php

namespace App\Http\Resources;

use App\Models\CardGroup;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
        $isUnLock = $this->is_lock == CardGroup::LOCK_STATUS_UNLOCK;

        if (!$isUnLock && Auth::check()) {
            $isUnLock = $this->isUnlock();
        }

        return [
            'id' => $this->id,
            'zh_name' => $this->zh_name,
            'en_name' => $this->en_name,
            'cover_url' => $this->cover_url,
            'is_unlock' => $isUnLock,
            'color' => $this->color,
            'cards' => CardResource::collection($this->whenLoaded('cards')),
        ];
    }
}
