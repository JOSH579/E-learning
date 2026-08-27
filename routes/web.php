<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
 setup/initial-project
    return auth()->check()
        ? redirect()->route('courses.index')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('courses', CourseController::class);
=======
    return view('blaze');
});
Route::get('/b', function () {
    return view('b');});
