<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VipSettingsRequest;
use App\Settings\VipSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function editVip(VipSettings $settings)
    {
        return view('admin.settings.vip', compact('settings'));
    }

    public function updateVip(VipSettingsRequest $request, VipSettings $settings)
    {
        $settings->fill($request->only([
            'price',
            'original_price',
            'duration',
        ]));
        $settings->save();

        return back()->with('success', '修改会员设置成功！');
    }
}
