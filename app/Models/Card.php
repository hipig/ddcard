<?php

namespace App\Models;

use App\Models\Traits\CoverAttribute;
use App\Models\Traits\OrderIndexScope;
use App\Models\Traits\StatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory, CoverAttribute, StatusScope, OrderIndexScope;

    protected $fillable = [
        'zh_name',
        'en_name',
        'zh_spell',
        'en_spell',
        'uk_spell',
        'cover',
        'color',
        'status',
        'index',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function group()
    {
        return $this->belongsTo(CardGroup::class, 'group_id');
    }
}
