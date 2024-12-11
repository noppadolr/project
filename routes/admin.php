<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;



Route::controller(AdminController::class)
    ->prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
        Route::get('/profile','profile')->name('profile');
        Route::post('update/profile','UpdateProfile')->name('update.profile');
        Route::get('/change/password','changePassword')->name('change.password');
        Route::post('update/password','UpdatePassword')->name('update.password');
});

Route::controller(AdminController::class)
    ->prefix('admin')
    ->name('admin.')

    ->group(function () {
        Route::get('/forgot', 'forgotPassword')->name('forgot.password');

    });



require __DIR__.'/auth.php';



