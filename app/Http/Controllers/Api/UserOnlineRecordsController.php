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
    public function update(Request $request)
    {
        $startedAt = $request->started_at;
        $endedAt = now();
        $record = UserOnlineRecord::firstOrCreate([
            'user_id' => Auth::id(),
            'date' => now()->format('Y-m-d')
        ]);

        $diffMinutes = Carbon::parse($startedAt)->diffInMinutes(Carbon::parse($endedAt));
        $record->increment('duration', $diffMinutes);
        $record->items()->create([
            'started_at' => $startedAt,
            'ended_at' => $endedAt,
        ]);

        return UserOnlineRecordResource::make($record);
    }

    public function show(Request $request)
    {
        $record = UserOnlineRecord::firstOrCreate([
            'user_id' => Auth::id(),
            'date' => now()->format('Y-m-d')
        ]);

        return UserOnlineRecordResource::make($record);
    }
}
