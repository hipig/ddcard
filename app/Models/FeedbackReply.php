<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeedbackReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'to_user_id',
        'feedback_id',
        'content',
        'viewed_at',
        'is_remind',
    ];

    protected $dates = [
        'viewed_at',
    ];

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'feedback_id');
    }
}
