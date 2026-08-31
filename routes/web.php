<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('blaze');
});
Route::get('/b', function () {
    return view('b');
});
Route::get('/bray', function () {
    return view('bray');
});
