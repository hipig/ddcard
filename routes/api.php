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

    Route::get('card-groups', [Api\CardGroupsController::class, 'index'])->name('cardGroups.index');
    Route::get('card-groups/{group}', [Api\CardGroupsController::class, 'show'])->name('cardGroups.show');

    Route::middleware('refresh.token')->group(function () {

        Route::get('me', [Api\UsersController::class, 'me'])->name('me');

    });

});
