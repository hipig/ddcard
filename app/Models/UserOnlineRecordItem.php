<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserOnlineRecordItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'started_at',
        'ended_at',
    ];

    protected $dates = [
        'started_at',
        'ended_at',
    ];

    public function record()
    {
        return $this->belongsTo(UserOnlineRecord::class, 'record_id');
    }
}
