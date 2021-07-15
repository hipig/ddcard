<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutRequest;
use App\ModelFilters\Admin\AboutFilter;
use App\Models\About;
use Illuminate\Http\Request;

class AboutsController extends Controller
{
    public function index(Request $request)
    {
        $abouts = About::filter($request->all(), AboutFilter::class)->latest()->paginate();

        return view('admin.abouts.index', compact('abouts'));
    }

    public function create()
    {
        return view('admin.abouts.create');
    }

    public function store(AboutRequest $request)
    {
        About::create($request->only([
            'name',
            'key',
            'content',
            'status',
        ]));

        return redirect()->route('admin.abouts.index')->with('success', '添加内容成功！');
    }

    public function edit(About $about)
    {
        return view('admin.abouts.edit',  compact('about'));
    }

    public function update(AboutRequest $request, About $about)
    {
        $about->fill($request->only([
            'name',
            'key',
            'content',
            'status',
        ]));
        $about->save();

        return back()->with('success', '修改内容成功！');
    }

    public function destroy(About $about)
    {
        $about->delete();

        return back()->with('success', '删除内容成功！');
    }
}
