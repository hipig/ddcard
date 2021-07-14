<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollectRecordResource;
use App\Models\Card;
use App\Models\CardGroup;
use App\Models\UserCollectRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserCollectRecordsController extends Controller
{
    public function index(Request $request)
    {
        $records = UserCollectRecord::query()->with('card')->latest()->get();

        return UserCollectRecordResource::collection($records);
    }

    public function store(Card $card)
    {
        $user = Auth::user();

        if ($card->group->is_lock === CardGroup::LOCK_STATUS_LOCK && $user->is_vip === -1) {
            throw new AccessDeniedHttpException('升级VIP，解锁全部卡组，收藏卡片学习更快捷');
        }

        $record = UserCollectRecord::firstOrCreate([
            'user_id' => $user->id,
            'card_id' => $card->id,
            'group_id' => $card->group_id,
        ]);

        return UserCollectRecordResource::make($record);
    }

    public function destroy(Card $card)
    {
        $record = Auth::user()->collectRecords()->where('card_id', $card->id)->first();
        $record->delete();

        return response(null, 204);
    }
}
