<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('pages.home');
})->middleware('auth')->name('home');

Route::get('/profile', function () {
    return view('pages.profile');
})->middleware('auth');

Route::get('/search', function () {
    return view('pages.search');
})->middleware('auth');

Route::get('/profile/edit', function () {
    return view('pages.updating-profile');
})->middleware('auth')->name('profile.edit');

Route::get('/password', function () {
    return view('auth.password-reset');
});

Route::get('/security', function () {
    return view('pages.security');
})->middleware('auth');

Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

require __DIR__.'/auth.php';
