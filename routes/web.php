<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\AuthorController;



Route::middleware(['guest:web'])->group(function () {
    Route::view('/author/login', 'back.pages.auth.login')->name('author.login');
    Route::view('/author/forgot-password', 'back.pages.auth.forgot')->name('author.forgot-password');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/author/home', [AuthorController::class, 'index'])->name('author.home');
    Route::post('/author/logout', [AuthorController::class, 'logout'])->name('author.logout');
    Route::view('/author/profile', 'back.pages.profile')->name('author.profile');
});

Route::get('/', function () {
    return redirect()->route('author.login');
});
