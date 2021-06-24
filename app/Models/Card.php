<?php

namespace App\Models;

use App\Models\Traits\CoverAttribute;
use App\Models\Traits\OrderIndexScope;
use App\Models\Traits\StatusScope;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Card extends Model
{
    use HasFactory, CoverAttribute, StatusScope, OrderIndexScope, Filterable;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    public static $statusMap = [
        self::STATUS_ENABLE => '启用',
        self::STATUS_DISABLE => '禁用',
    ];

    const COLOR_GRAY = 'gray';
    const COLOR_RED = 'red';
    const COLOR_YELLOW = 'yellow';
    const COLOR_GREEN = 'green';
    const COLOR_BLUE = 'blue';
    const COLOR_ORANGE = 'orange';
    const COLOR_TEAL = 'teal';
    const COLOR_INDIGO = 'indigo';
    const COLOR_PURPLE = 'purple';
    const COLOR_PINK = 'pink';
    public static $colorMap = [
        self::COLOR_GRAY => '灰色',
        self::COLOR_RED => '红色',
        self::COLOR_YELLOW => '黄色',
        self::COLOR_GREEN => '绿色',
        self::COLOR_BLUE => '蓝色',
        self::COLOR_ORANGE => '橘色',
        self::COLOR_TEAL => '青色',
        self::COLOR_INDIGO => '靛蓝色',
        self::COLOR_PURPLE => '紫色',
        self::COLOR_PINK => '粉色',
    ];

    protected $fillable = [
        'group_id',
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

    protected $appends = [
        'cover_url',
        'zh_audio_path_url',
        'en_audio_path_url',
    ];

    public function group()
    {
        return $this->belongsTo(CardGroup::class, 'group_id');
    }

    public function getzhAudioPathUrlAttribute()
    {
        $path = $this->attributes['zh_audio_path'];

        return $path ? Storage::disk('upload')->url($path) : '';
    }

    public function getenAudioPathUrlAttribute()
    {
        $path = $this->attributes['en_audio_path'];

        return $path ? Storage::disk('upload')->url($path) : '';
    }
}
