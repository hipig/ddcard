<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserUnlockRecord extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'user_id',
        'group_id',
    ];

    protected $dates = [
        'expired_at',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->expired_at = now()->addDay();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function group()
    {
        return $this->belongsTo(CardGroup::class, 'group_id');
    }
}
