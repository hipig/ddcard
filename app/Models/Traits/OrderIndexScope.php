<?php


namespace App\Models\Traits;


trait OrderIndexScope
{
    public function scopeOrderIndex($query, $direction = 'desc')
    {
        return $query->orderBy('index', $direction);
    }
}
