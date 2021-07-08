<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardGroupLearnResource;
use App\Http\Resources\UserLearnRecordResource;
use App\Models\Card;
use App\Models\CardGroup;
use App\Models\UserLearnRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLearnRecordsController extends Controller
{
    public function index()
    {
        $groups = CardGroup::query()
            ->with(['cards', 'learnRecords'])
            ->status()
            ->orderBy('is_lock')
            ->orderIndex()
            ->latest()
            ->get();

        return CardGroupLearnResource::collection($groups);
    }

    public function store(Request $request, Card $card)
    {
        $record = UserLearnRecord::firstOrCreate([
            'lang' => $request->lang,
            'user_id' => Auth::id(),
            'card_id' => $card->id,
            'group_id' => $card->group_id,
        ]);

        return UserLearnRecordResource::make($record);
    }

    public function destroy(Request $request, Card $card)
    {
        $record = Auth::user()->learnRecords()
            ->where('card_id', $card->id)
            ->where('lang', $request->lang)
            ->first();
        $record->delete();

        return response(null, 204);
    }
}
