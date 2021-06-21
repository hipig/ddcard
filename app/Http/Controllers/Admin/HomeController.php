<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Card;
use App\Models\CardGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        $counts = [
            'income' => number_format(0, 2),
            'user' => User::query()->whereDate('created_at', now()->format('Y-m-d'))->count(),
            'group' => CardGroup::query()->count(),
            'card' => Card::query()->count(),
        ];
        return view('admin.home.dashboard', compact('counts'));
    }

    public function showProfileForm()
    {
        $user = Auth::user();
        return view('admin.home.profile', compact('user'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = Auth::user();
        $user->fill($request->only('name'));

        if ($password = $request->input('passowrd')) {
            $user->password = $password;
        }
        $user->save();

        return back()->with('success', '更新个人资料成功！');
    }
}
