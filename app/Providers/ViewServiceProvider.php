<?php

namespace App\Providers;

use App\Http\ViewComposers\FilterUserComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['admin.records.*', 'admin.feedback.index'], FilterUserComposer::class);
    }
}
