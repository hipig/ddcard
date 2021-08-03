<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Api\UserRenewRequest;
use App\ModelFilters\Admin\UserFilter;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::filter($request->all(), UserFilter::class)->withCount('onlineRecords')->latest()->paginate();

        $plans = Plan::query()->status()->oldest()->get();

        return view('admin.users.index', compact('users', 'plans'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->only([
            'name',
            'phone',
            'email'
        ]));

        if ($password = $request->input('password')) {
            $user->password = $password;
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', '修改用户成功！');
    }

    public function renew(UserRenewRequest $request, User $user)
    {
        $plan = Plan::query()->where('id', $request->plan_id)->firstOrFail();

        $user->renew($plan->period, $plan->interval);

        return back()->with('success', '开通会员成功！');
    }
}
