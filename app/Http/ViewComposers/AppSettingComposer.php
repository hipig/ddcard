<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use App\Settings\AppSettings;
use Illuminate\View\View;

class AppSettingComposer
{
    public function compose(View $view)
    {
        $settings = app(AppSettings::class);
        $view->with('appSetting', $settings);
    }
}
