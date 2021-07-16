<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use EloquentFilter\Filterable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'phone',
        'email',
        'password',
        'weapp_openid',
        'weixin_session_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'vip_expired_at' => 'datetime',
    ];

    public function collectRecords()
    {
        return $this->hasMany(UserCollectRecord::class, 'user_id');
    }

    public function collectCards()
    {
        return $this->belongsToMany(Card::class, 'user_collect_records', 'user_id', 'card_id');
    }

    public function learnRecords()
    {
        return $this->hasMany(UserLearnRecord::class, 'user_id');
    }

    public function unlockRecords()
    {
        return $this->hasMany(UserUnlockRecord::class, 'user_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'user_id');
    }

    public function feedbackReplies()
    {
        return $this->hasMany(FeedbackReply::class, 'to_user_id');
    }

    public function renew($period, $interval)
    {
        if ($period === Plan::INFINITE_VALUE) {
            $endAt = new Carbon(Plan::INFINITE_TIME);
        } else {
            $expiredAt = $this->vip_expired_at;
            $startAt = now() > $expiredAt ? now() : $expiredAt;

            $method = 'add'.ucfirst($interval).'s';
            $endAt = $startAt->{$method}($period);
        }

        $this->attributes['vip_expired_at'] = $endAt;
        $this->save();
    }

    public function getIsVipAttribute()
    {
        $isVip = -1;
        if ($this->getAttribute('vip_expired_at') > now()) {
            $isVip = 1;
        }

        if ($this->getAttribute('vip_expired_at') === Plan::INFINITE_TIME) {
            $isVip = 2;
        }

        return $isVip;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
