<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\UserLearnRecordFilter;
use App\Models\CardGroup;
use App\Models\UserLearnRecord;
use Illuminate\Http\Request;

class UserLearnRecordsController extends Controller
{
    public function index(Request $request)
    {
        $groups = CardGroup::query()->with('cards')->get();
        $records = UserLearnRecord::filter($request->all(), UserLearnRecordFilter::class)->with('user', 'group', 'card')->latest()->paginate();

        return view('admin.records.learn', compact('groups', 'records'));
    }
}
