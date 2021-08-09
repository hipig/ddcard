<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class UserOnlineRecord extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'user_id',
        'duration',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];

    protected $dates = [
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(UserOnlineRecordItem::class, 'record_id');
    }
}
