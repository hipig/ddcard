<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CardGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ValidationsController extends Controller
{
    public function userIsVip(Request $request)
    {
        return response()->json([
            'is_vip' => optional($request->user())->is_vip ?? -1
        ]);
    }

    public function groupCanLearn(Request $request, CardGroup $group)
    {
        if ($group->is_lock === CardGroup::LOCK_STATUS_LOCK && Auth::user()->is_vip === -1) {
            throw new AccessDeniedHttpException('升级VIP，解锁全部卡组测试，随时随地想测就测');
        }

        return response(null);
    }
}
