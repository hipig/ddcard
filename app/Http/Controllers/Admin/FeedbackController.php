<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeedbackReplyRequest;
use App\ModelFilters\Admin\FeedbackFilter;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $feedback = Feedback::filter($request->all(), FeedbackFilter::class)->with('user')->latest()->paginate();

        return view('admin.feedback.index', compact('feedback'));
    }

    public function storeReply(FeedbackReplyRequest $request, Feedback $feedback)
    {
        $feedback->replies()->create([
            'to_user_id' => $feedback->user_id,
            'content' => $request->input('content'),
        ]);

        return back()->with('success', '添加回复成功！');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return back()->with('success', '删除反馈成功！');
    }
}
