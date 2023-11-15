<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthorController;


Route::prefix('author')->name('author.')->group(function () {
    Route::middleware(['guest:web'])->group(function () {
        Route::view('/login', 'back.pages.auth.login')->name('login');
        Route::view('/forgot-password', 'back.pages.auth.forgot')->name('forgot-password');
    });

    Route::middleware(['auth:web'])->group(function () {
        Route::get('/home', [AuthorController::class, 'index'])->name('home');
        Route::post('/logout', [AuthorController::class, 'logout'])->name('logout');
        Route::view('/profile', 'back.pages.profile')->name('profile');
        Route::view('/categories', 'back.pages.categories')->name('categories');

        Route::prefix('post')->name('posts.')->group(function () {
            Route::view('/add-post', 'back.pages.add-post')->name('add-post');
        });
    });
});
