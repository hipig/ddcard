<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserLearnRecordResource;
use App\Models\Card;
use App\Models\UserLearnRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLearnRecordsController extends Controller
{
    public function index()
    {

    }

    public function store(Card $card)
    {
        $record = new UserLearnRecord();
        $record->user()->associate(Auth::user());
        $record->card()->associate($card);
        $record->group()->associate($card->group);
        $record->save();

        return UserLearnRecordResource::make($record);
    }

    public function destroy(UserLearnRecord $record)
    {
        $record->delete();

        return response(null, 204);
    }
}
