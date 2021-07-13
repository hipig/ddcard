<?php


namespace App\Settings;


use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public int $daily_unlock_times;

    public static function group(): string
    {
        return 'general';
    }
}
