<?php

use App\Http\Controllers;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::prefix('admin')->as('admin.')->middleware('guard:admin')->group(function () {


    Route::middleware('admin.guest')->group(function () {

        Route::get('login', [Admin\AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [Admin\AuthenticatedSessionController::class, 'store']);

    });

    Route::middleware('admin.auth')->group(function () {

        Route::post('/logout', [Admin\AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::get('/profile', [Admin\HomeController::class, 'showProfileForm'])->name('profile');
        Route::post('/profile', [Admin\HomeController::class, 'updateProfile'])->name('profile.update');

        Route::get('/', [Admin\HomeController::class, 'dashboard'])->name('dashboard');

        Route::resource('users', Admin\UsersController::class)->except(['create', 'store', 'show']);
        Route::resource('plans', Admin\PlansController::class)->names('plans')->except(['show']);
        Route::resource('card-groups', Admin\CardGroupsController::class)->names('groups')->except(['show'])->parameters([
            'card-groups' => 'group'
        ]);
        Route::resource('cards', Admin\CardsController::class)->except(['show']);
        Route::post('cards/{card}/generate-audio', [Admin\CardsController::class, 'generateAudio'])->name('cards.generateAudio');

        Route::prefix('settings')->group(function () {
            Route::get('general', [Admin\SettingsController::class, 'editGeneral'])->name('settings.edit.general');
            Route::put('general', [Admin\SettingsController::class, 'updateGeneral'])->name('settings.update.general');
        });

        Route::prefix('records')->group(function () {
            Route::get('unlock', [Admin\UserUnlockRecordsController::class, 'index'])->name('records.unlock');
            Route::get('collect', [Admin\UserCollectRecordsController::class, 'index'])->name('records.collect');
            Route::get('learn', [Admin\UserLearnRecordsController::class, 'index'])->name('records.learn');
            Route::get('subscription', [Admin\UserSubscriptionRecordsController::class, 'index'])->name('records.subscription');
        });

        Route::resource('feedback', Admin\FeedbackController::class)->only(['index', 'destroy']);
        Route::post('feedback/{feedback}/replies', [Admin\FeedbackController::class, 'storeReply'])->name('feedback.storeReply');

        Route::prefix('filepond')->group(function () {
            Route::post('process', [Admin\FilepondUploadsController::class, 'process'])->name('filepond.process');
            Route::get('load', [Admin\FilepondUploadsController::class, 'load'])->name('filepond.load');
            Route::delete('revert', [Admin\FilepondUploadsController::class, 'revert'])->name('filepond.revert');
        });
    });

});
