<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardPreviewResource;
use App\Models\CardGroup;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function preview(Request $request, CardGroup $group)
    {
        $cards = $group->cards()
            ->status()
            ->orderIndex()
            ->oldest()
            ->get();

        return CardPreviewResource::collection($cards);
    }
}
