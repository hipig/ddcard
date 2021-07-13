<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserSubscriptionRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function wechatNotify()
    {
        $response = app('wechat.pay')->handlePaidNotify(function ($message, $fail) {
            // 找到对应的记录
            $record = UserSubscriptionRecord::query()->where('no', $message['out_trade_no'])->first();
            // 不存在则告知微信支付
            if (!$record) {
                $fail('Order not exist.');
            }
            // 已支付
            if ($record->paid_at) {
                // 告知微信支付此订单已处理
                return true;
            }

            // 标记为已支付
            $record->update([
                'paid_at'        => Carbon::now(),
                'payment_no'     => $message['transaction_id'],
            ]);

            return true;
        });

        return $response;
    }
}
