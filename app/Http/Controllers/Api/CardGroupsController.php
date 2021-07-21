<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardGroupResource;
use App\Models\CardGroup;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CardGroupsController extends Controller
{
    public function index()
    {
        $cardGroups = CardGroup::query()
            ->status()
            ->orderBy('is_lock')
            ->orderIndex()
            ->oldest()
            ->get();

        return CardGroupResource::collection($cardGroups);
    }

    public function show(Request $request, CardGroup $group)
    {
        if ($group->is_lock == CardGroup::LOCK_STATUS_LOCK && !$group->isUnlock()) {
            throw new AccessDeniedHttpException('非法访问，该卡组未解锁！');
        }

        $group->load(['cards' => function($query) {
            $query->status()->orderIndex()->latest();
        }, 'cards.collectRecords', 'cards.learnRecords']);

        return CardGroupResource::make($group);
    }
}
