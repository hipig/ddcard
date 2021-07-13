<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\UserCollectRecordFilter;
use App\Models\CardGroup;
use App\Models\UserCollectRecord;
use Illuminate\Http\Request;

class UserCollectRecordsController extends Controller
{
    public function index(Request $request)
    {
        $groups = CardGroup::query()->with('cards')->get();
        $records = UserCollectRecord::filter($request->all(), UserCollectRecordFilter::class)->with('user', 'group', 'card')->latest()->paginate();

        return view('admin.records.collect', compact('groups', 'records'));
    }
}
