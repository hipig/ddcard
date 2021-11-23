<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralSettingsRequest;
use App\Settings\AppSettings;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function editGeneral(GeneralSettings $settings)
    {
        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(GeneralSettingsRequest $request, GeneralSettings $settings)
    {
        $settings->fill($request->only([
            'daily_unlock_times',
            'vip_show',
        ]));
        $settings->save();

        return back()->with('success', '修改基础设置成功！');
    }

    public function editApp(AppSettings $settings)
    {
        return view('admin.settings.app', compact('settings'));
    }

    public function updateApp(Request $request, AppSettings $settings)
    {
        $settings->fill($request->only([
            'copyright',
        ]));
        $settings->save();

        return back()->with('success', '修改站点设置成功！');
    }
}
