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
    // 退出登录
    Route::delete('authorizations', [Api\AuthorizationsController::class, 'destroy'])->name('authorizations.destroy');

    // 卡片分组
    Route::get('card-groups', [Api\CardGroupsController::class, 'index'])->name('cardGroups.index');
    Route::get('card-groups/{group}', [Api\CardGroupsController::class, 'show'])->name('cardGroups.show');
    Route::get('card-groups/{group}/preview', [Api\CardsController::class, 'preview'])->name('cards.preview');

    // 会员方案
    Route::get('plans', [Api\PlansController::class, 'index'])->name('plans.index');

    // 支付回调
    Route::post('payment/wechat/notify', [Api\PaymentController::class, 'wechatNotify'])->name('payment.wechat.notify');

    // 校验卡组能否学习
    Route::get('validations/group-can-learn/{group}', [Api\ValidationsController::class, 'groupCanLearn'])->name('validations.groupCanLearn');

    // 关于我们
    Route::get('abouts/{about:key}', [Api\AboutsController::class, 'show'])->name('abouts.show');

    // 基础设置
    Route::get('settings/general', [Api\SettingsController::class, 'general'])->name('settings.general');

    // 不需要登录的记录
    Route::prefix('records')->as('records.')->group(function () {

        // 在线记录
        Route::get('online/cumulative', [Api\UserOnlineRecordsController::class, 'cumulativeTimes'])->name('online.cumulativeTimes');
        Route::post('online', [Api\UserOnlineRecordsController::class, 'store'])->name('online.store');
        Route::put('online/{record}', [Api\UserOnlineRecordsController::class, 'update'])->name('online.update');

        // 学习记录
        Route::get('learn', [Api\UserLearnRecordsController::class, 'index'])->name('learn.index');

        // 收藏记录
        Route::get('collect', [Api\UserCollectRecordsController::class, 'index'])->name('collect.index');

    });

    Route::middleware('auth.renew')->group(function () {

        // 个人资料
        Route::get('me', [Api\UsersController::class, 'me'])->name('me');

        Route::prefix('records')->as('records.')->group(function () {

            // 学习记录
            Route::post('learn/{card}', [Api\UserLearnRecordsController::class, 'store'])->name('learn.store');
            Route::delete('learn/{card}', [Api\UserLearnRecordsController::class, 'destroy'])->name('learn.destroy');

            // 收藏记录
            Route::post('collect/{card}', [Api\UserCollectRecordsController::class, 'store'])->name('collect.store');
            Route::delete('collect/{card}', [Api\UserCollectRecordsController::class, 'destroy'])->name('collect.destroy');

            // 解锁记录
            Route::post('unlock/{group}', [Api\UserUnlockRecordsController::class, 'store'])->name('unlock.store');

            // 会员订阅
            Route::post('subscription/{plan}', [Api\UserSubscriptionRecordController::class, 'store'])->name('subscription.store');

        });

        // 留言反馈
        Route::get('feedback', [Api\FeedbackController::class, 'index'])->name('feedback.index');
        Route::post('feedback', [Api\FeedbackController::class, 'store'])->name('feedback.store');
        Route::put('feedback/view-reply', [Api\FeedbackController::class, 'viewReply'])->name('feedback.viewReply');

    });

});
