<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use Illuminate\View\View;

class FilterUserComposer
{
    public function compose(View $view)
    {
        $users = User::query()->latest()->get(['id', 'name']);
        $view->with('filterUsers', $users);
    }
}
