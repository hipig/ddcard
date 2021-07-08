<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserUnlockRecordResource;
use App\Models\CardGroup;
use App\Models\UserUnlockRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserUnlockRecordsController extends Controller
{
    public function store(CardGroup $group)
    {
        $user = Auth::user();

        if (!$group->validateUnlockLimit($user)) {
            throw new AccessDeniedHttpException('超过当日解锁次数');
        }

        $record = new UserUnlockRecord();
        $record->user()->associate($user);
        $record->group()->associate($group);
        $record->save();

        return UserUnlockRecordResource::make($record);
    }
}
