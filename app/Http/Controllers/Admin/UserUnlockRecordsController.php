<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\UserUnlockRecordFilter;
use App\Models\CardGroup;
use App\Models\UserUnlockRecord;
use Illuminate\Http\Request;

class UserUnlockRecordsController extends Controller
{
    public function index(Request $request)
    {
        $groups = CardGroup::query()->get();
        $records = UserUnlockRecord::filter($request->all(), UserUnlockRecordFilter::class)->with('user', 'group')->latest()->paginate();

        return view('admin.records.unlock', compact('groups', 'records'));
    }
}
