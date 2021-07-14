<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSubscriptionRecord extends Model
{
    use HasFactory, Filterable;

    const INTERVAL_DAY = 'day';
    const INTERVAL_MONTH = 'month';
    const INTERVAL_YEAR = 'year';
    public static $intervalMap = [
        self::INTERVAL_DAY => '天',
        self::INTERVAL_MONTH => '个月',
        self::INTERVAL_YEAR => '年',
    ];

    protected $fillable = [
        'no',
        'user_id',
        'plan_id',
        'amount',
        'period',
        'interval',
        'paid_at',
        'payment_no',
    ];

    protected $dates = [
        'paid_at',
    ];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->no) {
                // 调用 findAvailableNo 生成订单流水号
                $model->no = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if (!$model->no) {
                    return false;
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix.str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('no', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('find order no failed');

        return false;
    }

    public function getIntervalTextAttribute()
    {
        return self::$intervalMap[$this->getAttribute('interval')] ?? '未知周期';
    }
}
