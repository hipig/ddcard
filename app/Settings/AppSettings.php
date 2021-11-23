<?php


namespace App\Settings;


use Spatie\LaravelSettings\Settings;

class AppSettings extends Settings
{

    public string $copyright;

    public static function group(): string
    {
        return 'app';
    }
}
