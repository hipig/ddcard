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
    const COLOR_LIME = 'lime';
    const COLOR_GREEN = 'green';
    const COLOR_BLUE = 'blue';
    const COLOR_ORANGE = 'orange';
    const COLOR_TEAL = 'teal';
    const COLOR_INDIGO = 'indigo';
    const COLOR_PURPLE = 'purple';
    const COLOR_PINK = 'pink';
    public static $bgColorMap = [
        self::COLOR_GRAY => 'bg-gray-600',
        self::COLOR_RED => 'bg-red-600',
        self::COLOR_YELLOW => 'bg-yellow-600',
        self::COLOR_LIME => 'bg-lime-600',
        self::COLOR_GREEN => 'bg-green-600',
        self::COLOR_BLUE => 'bg-blue-600',
        self::COLOR_ORANGE => 'bg-orange-600',
        self::COLOR_TEAL => 'bg-teal-600',
        self::COLOR_INDIGO => 'bg-indigo-600',
        self::COLOR_PURPLE => 'bg-purple-600',
        self::COLOR_PINK => 'bg-pink-600',
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

    public function collectRecords()
    {
        return $this->hasMany(UserCollectRecord::class, 'card_id');
    }

    public function learnRecords()
    {
        return $this->hasMany(UserLearnRecord::class, 'card_id');
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
