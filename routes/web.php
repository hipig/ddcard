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

Route::middleware('guest')->group(function () {

    Route::get('login', [Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [Auth\AuthenticatedSessionController::class, 'store']);

    Route::get('register', [Auth\RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [Auth\RegisteredUserController::class, 'store']);

    Route::get('forgot-password', [Auth\PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [Auth\PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [Auth\NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [Auth\NewPasswordController::class, 'store'])->name('password.update');

});

Route::middleware('auth')->group(function () {

    Route::get('/verify-email', [Auth\EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', [Auth\VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('/email/verification-notification', [Auth\EmailVerificationNotificationController::class, 'store'])->middleware(['throttle:6,1'])->name('verification.send');

    Route::get('/confirm-password', [Auth\ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('/confirm-password', [Auth\ConfirmablePasswordController::class, 'store']);

    Route::post('/logout', [Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

});


Route::prefix('admin')->as('admin.')->middleware('admin.default')->group(function () {


    Route::middleware('admin.guest')->group(function () {

        Route::get('login', [Admin\AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [Admin\AuthenticatedSessionController::class, 'store']);

    });

    Route::middleware('admin.auth')->group(function () {

        Route::post('/logout', [Admin\AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    });

});
