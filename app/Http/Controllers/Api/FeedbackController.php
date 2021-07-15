<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FeedbackRequest;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Auth::user()->feedback()->with('replies')->oldest()->get();

        return FeedbackResource::collection($feedback);
    }

    public function store(FeedbackRequest $request)
    {
        $feedback = Auth::user()->feedback()->create($request->only([
            'content'
        ]));

        return FeedbackResource::make($feedback);
    }

    public function viewReply(Request $request)
    {
        Auth::user()->feedbackReplies()->whereNull('viewed_at')->update([
           'viewed_at' => now(),
        ]);

        return response(null);
    }
}
