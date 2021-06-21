<?php


namespace App\Settings;


use Spatie\LaravelSettings\Settings;

class VipSettings extends Settings
{
    const DURATION_MONTH = 'month';
    const DURATION_YEAR = 'year';
    const DURATION_INDEFINITE = 'indefinite';

    public float $price;
    public float $original_price;
    public string $duration;

    public static function group(): string
    {
        return 'vip';
    }

    public static function getDurationMap()
    {
        return [
            self::DURATION_MONTH => '一个月',
            self::DURATION_YEAR => '一年',
            self::DURATION_INDEFINITE => '无限期',
        ];
    }
}
