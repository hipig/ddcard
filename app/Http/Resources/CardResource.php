<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $collectRecord = $this->collectRecords()->where('user_id', Auth::id())->first();
        $zhLearnRecord = $this->learnRecords()->where('user_id', Auth::id())->where('lang', 'zh')->first();
        $enLearnRecord = $this->learnRecords()->where('user_id', Auth::id())->where('lang', 'en')->first();

        return [
            'id' => $this->id,
            'zh_name' => $this->zh_name,
            'en_name' => $this->en_name,
            'zh_spell' => $this->zh_spell,
            'en_spell' => $this->en_spell,
            'uk_spell' => $this->uk_spell,
            'zh_audio_path_url' => $this->zh_audio_path_url,
            'en_audio_path_url' => $this->en_audio_path_url,
            'cover_url' => $this->cover_url,
            'color' => $this->color,
            'is_collect' => !is_null($collectRecord),
            'zh_is_learn' => !is_null($zhLearnRecord),
            'en_is_learn' => !is_null($enLearnRecord),
        ];
    }
}
