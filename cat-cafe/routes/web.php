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

//ブログ
Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->name(
    'admin.blogs.index',
);
Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->name(
    'admin.blogs.create',
);
Route::post('admin/blogs', [AdminBlogController::class, 'store'])->name(
    'admin.blogs.store',
);
Route::get('/admin/blogs/{blog}', [AdminBlogController::class, 'edit'])->name(
    'admin.blogs.edit',
);
Route::put('/admin/blogs/{blog}', [AdminBlogController::class, 'update'])->name(
    'admin.blogs.update',
);
Route::delete('/admin/blogs/{blog}', [
    AdminBlogController::class,
    'destroy',
])->name('admin.blogs.destroy');

//ユーザ管理
Route::get('/admin/users/create', [UserController::class, 'create'])->name(
    'admin.users.create',
);
Route::post('/admin/users/create', [UserController::class, 'store'])->name(
    'admin.users.store',
);

//ログイン処理
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name(
    'admin.login',
);
Route::post('/admin/login', [AuthController::class, 'login']);

//ログアウト処理
Route::post('/admin/logout', [AuthController::class, 'logout'])->name(
    'admin.logout',
);
