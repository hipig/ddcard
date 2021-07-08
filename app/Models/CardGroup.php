<?php

namespace App\Models;

use App\Models\Traits\OrderIndexScope;
use App\Models\Traits\StatusScope;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CardGroup extends Model
{
    use HasFactory, StatusScope, OrderIndexScope, Filterable;

    const LOCK_STATUS_UNLOCK = 1;
    const LOCK_STATUS_LOCK = 2;
    public static $lockStatusMap = [
        self::LOCK_STATUS_UNLOCK => '免费',
        self::LOCK_STATUS_LOCK => '锁定',
    ];

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
        'zh_name',
        'en_name',
        'cover',
        'color',
        'is_lock',
        'status',
        'index',
    ];

    protected $appends = [
        'cover_url',
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'group_id');
    }

    public function learnRecords()
    {
        return $this->hasMany(UserLearnRecord::class, 'group_id');
    }

    public function unlockRecords()
    {
        return $this->hasMany(UserUnlockRecord::class, 'group_id');
    }

    public function isUnlock($user = null, $date = null)
    {
        $user = $user ?? Auth::user();
        $date = $date ?? now()->format('y-m-d');

        // todo::判断用户是否为 vip

        return $this->unlockRecords()
            ->where('user_id', $user->id)
            ->whereDate('created_at', $date)
            ->exists();
    }

    public function validateUnlockLimit($user = null)
    {
        $user = $user ?? Auth::user();

        $count = $this->unlockRecords()
            ->where('user_id', $user->id)
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->count();

        return $count <= 5;
    }

    public function getCoverUrlAttribute()
    {
        $cover = $this->attributes['cover'];
        if(!$cover || Str::startsWith($cover,['http://','https://'])){
            return $cover;
        }
        return Storage::disk('upload')->url($cover);
    }
}
