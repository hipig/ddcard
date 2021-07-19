<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CardGroupLearnResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $count = $this->cards()->count();
        $zhLearnCount = $this->learnRecords()->where('user_id', Auth::id())->where('lang', 'zh')->count();
        $enLearnCount = $this->learnRecords()->where('user_id', Auth::id())->where('lang', 'en')->count();

        return [
            'id' => $this->id,
            'zh_name' => $this->zh_name,
            'en_name' => $this->en_name,
            'cover_url' => $this->cover_url,
            'color' => $this->color,
            'count' => $count,
            'zh_count' => $zhLearnCount,
            'en_count' => $enLearnCount,
        ];
    }
}
