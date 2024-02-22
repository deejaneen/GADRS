<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::get('/gym', function () {
    return view('gym');
})->name('gym');
Route::get('/dorm', function () {
    return view('dorm');
})->name('dorm');
Route::get('/logout', function () {
    return view('logout');
})->name('logout');