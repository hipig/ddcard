<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.vip_show', 1);
        $this->migrator->add('general.daily_unlock_times', 3);
    }
}
