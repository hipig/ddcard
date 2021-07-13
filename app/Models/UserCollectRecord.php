<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCollectRecord extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
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
