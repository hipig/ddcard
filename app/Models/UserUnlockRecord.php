<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUnlockRecord extends Model
{
    use HasFactory;

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
