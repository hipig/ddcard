<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLearnRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang',
        'user_id',
        'group_id',
        'card_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function group()
    {
        return $this->belongsTo(CardGroup::class, 'group_id');
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }
}
