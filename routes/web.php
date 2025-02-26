<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseVideoController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscribeTransactionController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

//digunakan user hanya melihat saja tanpa authentication
Route::get('/', [FrontController::class, 'index'])->name('front.index');
//{course:slug} membuat dinamis : /details/belajar-mtk
Route::get('/details/{course:slug}', [FrontController::class, 'details'])->name('front.details');

Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('front.pricing');

Route::middleware('auth')->group(function () {
    //get ini mengambil data dari server
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //patch update parsial pada sumber daya
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [FrontController::class, 'checkout'])->name('front.checkout')
        ->middleware('role:student');
    //post mengirim data keserv
    Route::post('/checkout/store', [FrontController::class, 'checkout_store'])->name('front.checkout.store')
        ->middleware('role:student');

    //nanti hasilnya domain.com/learning/100/5 = belajar Js
    Route::get('/learning/{course}/{courseVideoId}', [FrontController::class, 'learning'])->name('front.learning')
        ->middleware('role:student|teacher|owner');

    Route::prefix('admin')->name('admin.')->group(function () {
        //alasan pakai resource hanya sekali pakai saja jadi pakai tinggal : admin.categories.index (index ada dicontroller)
        //why middleware : yang bis akses hanya owner
        Route::resource('categories', CategoryController::class)
            ->middleware('role:owner');

        Route::resource('teachers', TeacherController::class)
            ->middleware('role:owner');

        Route::resource('courses', CourseController::class)
            ->middleware('role:owner|teacher');

        Route::resource('subscribe_transaction', SubscribeTransactionController::class)
            ->middleware('role:owner');

        Route::get('/add/video/{course:id}', [CourseVideoController::class, 'create'])
            ->middleware('role:teacher|owner')
            ->name('course.add_video');

        Route::post('/add/video/save/{course:id}', [CourseVideoController::class, 'store'])
            ->middleware('role:teacher|owner')
            ->name('course.add_video.save');

        Route::resource('course_videos', CourseVideoController::class)
            ->middleware('role:owner|teacher');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__ . '/auth.php';