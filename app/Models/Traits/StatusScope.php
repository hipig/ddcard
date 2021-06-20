<?php


namespace App\Models\Traits;

trait StatusScope
{
    public function scopeStatus($query, $status = true)
    {
        return $query->where('status', $status);
    }
}
