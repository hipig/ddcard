<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->as('api.v1.')->middleware('guard:api')->group(function () {

    // 小程序登录
    Route::post('weapp/authorizations', [Api\AuthorizationsController::class, 'weappStore'])->name('weapp.authorizations.store');

    // 卡片分组
    Route::get('card-groups', [Api\CardGroupsController::class, 'index'])->name('cardGroups.index');
    Route::get('card-groups/{group}', [Api\CardGroupsController::class, 'show'])->name('cardGroups.show');
    Route::get('card-groups/{group}/preview', [Api\CardsController::class, 'preview'])->name('cards.preview');

    // 会员方案
    Route::get('plans', [Api\PlansController::class, 'index'])->name('plans.index');

    Route::middleware('refresh.token')->group(function () {

        // 个人资料
        Route::get('me', [Api\UsersController::class, 'me'])->name('me');

        Route::prefix('records')->as('records.')->group(function () {

            // 学习记录
            Route::get('learn', [Api\UserLearnRecordsController::class, 'index'])->name('learn.index');
            Route::post('learn/{card}', [Api\UserLearnRecordsController::class, 'store'])->name('learn.store');
            Route::delete('learn/{card}', [Api\UserLearnRecordsController::class, 'destroy'])->name('learn.destroy');

            // 收藏记录
            Route::get('collect', [Api\UserCollectRecordsController::class, 'index'])->name('collect.index');
            Route::post('collect/{card}', [Api\UserCollectRecordsController::class, 'store'])->name('collect.store');
            Route::delete('collect/{card}', [Api\UserCollectRecordsController::class, 'destroy'])->name('collect.destroy');

            // 解锁记录
            Route::post('unlock/{group}', [Api\UserUnlockRecordsController::class, 'store'])->name('unlock.store');

            // 在线记录
            Route::get('online', [Api\UserOnlineRecordsController::class, 'show'])->name('online.show');
            Route::put('online', [Api\UserOnlineRecordsController::class, 'update'])->name('online.update');

        });

    });

});
