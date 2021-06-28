<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollectRecordResource;
use App\Models\Card;
use App\Models\UserCollectRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCollectRecordsController extends Controller
{
    public function index(Request $request)
    {
        $records = UserCollectRecord::query()->get();

        return UserCollectRecordResource::collection($records);
    }

    public function store(Card $card)
    {
        $record = new UserCollectRecord();
        $record->user()->associate(Auth::user());
        $record->card()->associate($card);
        $record->group()->associate($card->group);
        $record->save();

        return UserCollectRecordResource::make($record);
    }

    public function destroy(Card $card)
    {
        $record = Auth::user()->collectRecords()->where('card_id', $card->id)->first();
        $record->delete();

        return response(null, 204);
    }
}
