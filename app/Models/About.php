<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory, Filterable;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    public static $statusMap = [
        self::STATUS_ENABLE => '启用',
        self::STATUS_DISABLE => '禁用',
    ];

    protected $fillable = [
        'name',
        'key',
        'content',
        'status',
    ];
}
