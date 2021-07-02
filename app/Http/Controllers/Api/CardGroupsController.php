<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardGroupResource;
use App\Models\CardGroup;
use Illuminate\Http\Request;

class CardGroupsController extends Controller
{
    public function index()
    {
        $cardGroups = CardGroup::query()
            ->status()
            ->orderBy('is_lock')
            ->orderIndex()
            ->latest()
            ->get();

        return CardGroupResource::collection($cardGroups);
    }

    public function show(Request $request, CardGroup $group)
    {
        $group->load(['cards' => function($query) {
            $query->status()->orderIndex()->latest();
        }, 'cards.collectRecords', 'cards.learnRecords']);

        return CardGroupResource::make($group);
    }
}
