<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });

Route::view('/', 'index');

//問い合わせ内容
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact', [ContactController::class, 'sendMail']);
Route::get('/contact/complete', [ContactController::class, 'complete'])->name(
    'contact.complete',
);

Route::prefix('/admin')
    ->name('admin.')
    ->group(function () {
        //ログイン時のみアクセス可能
        Route::middleware('auth')->group(function () {
            //ブログ
            Route::resource('blogs', AdminBlogController::class)->except(
                'show',
            );
            //ユーザ管理
            Route::get('/users/create', [
                UserController::class,
                'create',
            ])->name('users.create');
            Route::post('/users/create', [
                UserController::class,
                'store',
            ])->name('users.store');

            //ログアウト処理
            Route::post('/admin/logout', [
                AuthController::class,
                'logout',
            ])->name('logout');
        });

        //未ログイン時のみアクセス可能なルート
        Route::middleware('guest')->group(function () {
            //ログイン処理
            Route::get('/login', [
                AuthController::class,
                'showLoginForm',
            ])->name('login');
            Route::post('/login', [AuthController::class, 'login']);
        });
    });
