<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\UserSubscriptionRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSubscriptionRecordController extends Controller
{
    public function store(Request $request, Plan $plan)
    {
        $user  = $request->user();

        $record = new UserSubscriptionRecord([
            'amount' => $plan->price,
            'period' => $plan->period,
            'interval' => $plan->interval,
        ]);
        $record->user()->associate($user);
        $record->plan()->associate($plan);
        $record->save();

        $app = app('wechat.pay');
        $jssdk = $app->jssdk;

        $result = $app->order->unify([
            'body' => '赞助会员' . $plan->name,
            'out_trade_no' => $record->no,
            'total_fee' => $record->amount * 100,
            'trade_type' => 'JSAPI',
            'openid' => $user->weapp_openid,
        ]);

        if ($result['return_code'] == 'FAIL') {
            abort(500, $result['return_msg'] ?? '生成订单失败！');
        }

        return $jssdk->sdkConfig($result['prepay_id']);
    }
}
