<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CardRequest;
use App\ModelFilters\Admin\CardFilter;
use App\Models\Card;
use App\Models\CardGroup;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function index(Request $request)
    {
        $cards = Card::filter($request->all(), CardFilter::class)->with('group')->latest()->paginate();

        $groups = CardGroup::query()->latest()->get();

        return view('admin.cards.index', compact('cards', 'groups'));
    }

    public function create()
    {
        $groups = CardGroup::query()->latest()->get();

        return view('admin.cards.create', compact('groups'));
    }

    public function store(CardRequest $request)
    {
        Card::create($request->only([
            'group_id',
            'zh_name',
            'en_name',
            'zh_spell',
            'en_spell',
            'uk_spell',
            'cover',
            'color',
            'status',
            'index',
        ]));

        return redirect()->route('admin.cards.index')->with('success', '添加卡片成功！');
    }

    public function edit(Card $card)
    {
        $groups = CardGroup::query()->latest()->get();

        return view('admin.cards.edit',  compact('card', 'groups'));
    }

    public function update(CardRequest $request, Card $card)
    {
        $card->fill($request->only([
            'group_id',
            'zh_name',
            'en_name',
            'zh_spell',
            'en_spell',
            'uk_spell',
            'cover',
            'color',
            'status',
            'index',
        ]));
        $card->save();

        return redirect()->route('admin.cards.index')->with('success', '修改卡片成功！');
    }

    public function destroy(Card $card)
    {
        $card->delete();

        return redirect()->route('admin.cards.index')->with('success', '删除卡片成功！');
    }
}
