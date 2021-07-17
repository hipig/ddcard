<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserOnlineRecordResource;
use App\Models\UserOnlineRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserOnlineRecordsController extends Controller
{
    public function store(Request $request)
    {
        $method = Auth::check() ? 'firstOrCreate' : 'create';
        $record = UserOnlineRecord::$method([
            'user_id' => Auth::id() ?? 0,
            'date' => now()->format('Y-m-d')
        ]);

        return UserOnlineRecordResource::make($record->append('cumulative_times'));
    }

    public function update(Request $request, UserOnlineRecord $record)
    {
        $startedAt = $request->started_at;
        $endedAt = now();
        $diffInSeconds = Carbon::parse($startedAt)->diffInSeconds(Carbon::parse($endedAt));
        $record->increment('duration', ($diffInSeconds % 60) > 30 ? ($diffInSeconds / 60) + 1 : $diffInSeconds / 60);
        $record->items()->create([
            'started_at' => $startedAt,
            'ended_at' => $endedAt,
        ]);

        return UserOnlineRecordResource::make($record);
    }
}
