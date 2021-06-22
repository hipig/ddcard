<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
