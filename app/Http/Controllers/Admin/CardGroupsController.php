<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CardGroupRequest;
use App\ModelFilters\Admin\CardGroupFilter;
use App\Models\CardGroup;
use Illuminate\Http\Request;

class CardGroupsController extends Controller
{
    public function index(Request $request)
    {
        $groups = CardGroup::filter($request->all(), CardGroupFilter::class)->withCount('cards')->latest()->paginate();

        return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        return view('admin.groups.create');
    }

    public function store(CardGroupRequest $request)
    {
        CardGroup::create($request->only([
            'zh_name',
            'en_name',
            'cover',
            'color',
            'is_lock',
            'status',
            'index',
        ]));

        return redirect()->route('admin.groups.index')->with('success', '添加卡片分组成功！');
    }

    public function edit(CardGroup $group)
    {
        return view('admin.groups.edit',  compact('group'));
    }

    public function update(CardGroupRequest $request, CardGroup $group)
    {
        $group->fill($request->only([
            'zh_name',
            'en_name',
            'cover',
            'color',
            'is_lock',
            'status',
            'index',
        ]));
        $group->save();

        return back()->with('success', '修改卡片分组成功！');
    }

    public function destroy(CardGroup $group)
    {
        $group->delete();

        return back()->with('success', '删除卡片分组成功！');
    }
}
