<?php

namespace App\Models;

use App\Models\Traits\OrderIndexScope;
use App\Models\Traits\StatusScope;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory, StatusScope, OrderIndexScope, Filterable;

    const INTERVAL_DAY = 'day';
    const INTERVAL_MONTH = 'month';
    const INTERVAL_YEAR = 'year';
    public static $intervalMap = [
        self::INTERVAL_DAY => '天',
        self::INTERVAL_MONTH => '个月',
        self::INTERVAL_YEAR => '年',
    ];

    const TAG_RECOMMEND = 'recommend';
    const TAG_LIMIT = 'limit';
    public static $tagMap = [
        self::TAG_RECOMMEND => '推荐',
        self::TAG_LIMIT => '限时',
    ];

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    public static $statusMap = [
        self::STATUS_ENABLE => '启用',
        self::STATUS_DISABLE => '禁用',
    ];


    protected $fillable = [
        'name',
        'price',
        'period',
        'interval',
        'description',
        'tag',
        'status',
        'index',
    ];

    protected $casts = [
        'price' => 'float',
        'status' => 'boolean',
    ];

    public function getIntervalTextAttribute()
    {
        return self::$intervalMap[$this->getAttribute('interval')] ?? '未知周期';
    }
}
