<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminBlogController;
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
