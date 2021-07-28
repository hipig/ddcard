<?php

namespace App\Models;

use App\Models\Traits\OrderIndexScope;
use App\Models\Traits\StatusScope;
use App\Settings\GeneralSettings;
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

        return $user->is_vip > 0 || $this->unlockRecords()
            ->where('user_id', $user->id)
            ->where('expired_at', '>', $date)
            ->exists();
    }

    public function getCoverUrlAttribute()
    {
        $cover = $this->attributes['cover'];
        if (!$cover) {
            $firstCard = $this->cards()->status()->orderIndex()->oldest()->first();
            return $firstCard->cover_url ?? '';
        }
        if(Str::startsWith($cover,['http://','https://'])){
            return $cover;
        }
        return Storage::disk('upload')->url($cover);
    }
}
