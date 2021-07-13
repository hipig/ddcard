<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index()
    {
        $plans = Plan::query()
            ->status()
            ->orderIndex()
            ->latest()
            ->get();

        return PlanResource::collection($plans);
    }
}
