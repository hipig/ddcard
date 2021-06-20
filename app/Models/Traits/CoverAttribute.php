<?php


namespace App\Models\Traits;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait CoverAttribute
{
    public function getCoverUrlAttribute()
    {
        $cover = $this->attributes['cover'];
        if(!$cover || Str::startsWith($cover,['http://','https://'])){
            return $cover;
        }
        return Storage::disk('upload')->url($cover);
    }
}
