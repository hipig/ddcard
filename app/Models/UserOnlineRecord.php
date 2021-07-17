<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class UserOnlineRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'duration',
        'date',
    ];

    protected $dates = [
        'date',
    ];

    public function items()
    {
        return $this->hasMany(UserOnlineRecordItem::class, 'record_id');
    }

    public function getCumulativeTimesAttribute($key)
    {
        return Auth::check() ? static::query()->where('user_id', Auth::id())->count() : 1;
    }
}
