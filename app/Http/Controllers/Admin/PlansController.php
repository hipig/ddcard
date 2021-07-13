<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanRequest;
use App\ModelFilters\Admin\PlanFilter;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index(Request $request)
    {
        $plans = Plan::filter($request->all(), PlanFilter::class)->latest()->paginate();

        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(PlanRequest $request)
    {
        Plan::create($request->only([
            'name',
            'price',
            'period',
            'interval',
            'description',
            'tag',
            'status',
            'index',
        ]));

        return redirect()->route('admin.plans.index')->with('success', '添加会员方案成功！');
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(PlanRequest $request, Plan $plan)
    {
        $plan->fill($request->only([
            'name',
            'price',
            'period',
            'interval',
            'description',
            'tag',
            'status',
            'index',
        ]));
        $plan->save();

        return back()->with('success', '修改会员方案成功！');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return back()->with('success', '删除会员方案成功！');
    }
}
