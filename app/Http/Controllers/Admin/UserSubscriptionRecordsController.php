<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\UserSubscriptionRecordFilter;
use App\Models\Plan;
use App\Models\UserSubscriptionRecord;
use Illuminate\Http\Request;

class UserSubscriptionRecordsController extends Controller
{
    public function index(Request $request)
    {
        $plans = Plan::query()->latest()->get();
        $records = UserSubscriptionRecord::filter($request->all(), UserSubscriptionRecordFilter::class)->with('user')->latest()->paginate();

        return view('admin.records.subscription', compact('plans', 'records'));
    }
}
