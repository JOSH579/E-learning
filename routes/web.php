<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseSearchController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LessonCompletionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('courses.index')
        : redirect()->route('blaze');
});

Route::get('/blaze', [WelcomeController::class, 'blaze'])->name('blaze');

Route::get('/preview/courses/{course}', [WelcomeController::class, 'coursePreview'])
    ->name('courses.preview');

Route::get('/preview/courses/{course}/lessons/{lesson}', [WelcomeController::class, 'lessonPreview'])
    ->name('courses.lessons.preview');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/b', [RegisterController::class, 'create'])->name('register');
    Route::post('/b', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    // Register search before the courses resource so /courses/search
    // is not treated as courses/{course} with course = "search".
    Route::get('/courses/search', [CourseSearchController::class, 'create'])->name('courses.search');
    Route::get('/courses/search/results', [CourseSearchController::class, 'index'])->name('courses.search.results');
    Route::post('/shop/orders', [ShopController::class, 'store'])->name('shop.orders.store');

    Route::resource('courses', CourseController::class);

    Route::resource('courses.modules', ModuleController::class)->except(['index']);
    Route::resource('courses.modules.lessons', LessonController::class)->except(['index']);

    Route::get('/my-courses', [EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('courses.enroll');
    Route::delete('/courses/{course}/enroll', [EnrollmentController::class, 'destroy'])->name('courses.unenroll');

Route::get('/couses.search', function () {
    return view('search');
});
    //Lesson Completion
        Route::post(
        '/courses/{course}/modules/{module}/lessons/{lesson}/complete',
        [LessonCompletionController::class, 'store']
    )->name('courses.modules.lessons.complete');

    Route::delete(
        '/courses/{course}/modules/{module}/lessons/{lesson}/complete',
        [LessonCompletionController::class, 'destroy']
    )->name('courses.modules.lessons.uncomplete');
});

Route::redirect('/search', '/courses/search');

Route::get('/tranding', [WelcomeController::class, 'tranding'])->name('tranding');
Route::redirect('/trading', '/tranding');
