<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateVipSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('vip.price', 0.00);
        $this->migrator->add('vip.original_price', 0.00);
        $this->migrator->add('vip.duration', 'month');
    }
}
