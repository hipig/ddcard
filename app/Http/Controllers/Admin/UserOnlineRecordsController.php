<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\UserOnlineRecordFilter;
use App\Models\UserOnlineRecord;
use Illuminate\Http\Request;

class UserOnlineRecordsController extends Controller
{
    public function index(Request $request)
    {
        $records = UserOnlineRecord::filter($request->all(), UserOnlineRecordFilter::class)->with('user')->latest()->paginate();

        return view('admin.records.online', compact('records'));
    }

    public function showItems(Request $request, UserOnlineRecord $record)
    {
        $items = $record->items()->latest()->get();
        return view('admin.records.online-items', compact('items'));
    }
}
