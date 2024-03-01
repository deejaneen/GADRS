<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('auth.login');
});

Route::get('/gym', function () {
    return view('gym');
})->name('gym');
Route::get('/dorm', function () {
    return view('dorm');
})->name('dorm');

Route::get('/profile', function () {
    return view('../profile/profile');
})->name('profile');
Route::get('/passwordprofile', function () {
    return view('../profile/passwordprofile');
})->name('passwordprofile');
Route::get('/reservationhistoryprofile', function () {
    return view('../profile/reservationhistoryprofile');
})->name('reservationhistoryprofile');
Route::get('/home', function () {
    return view('home');
})->name('home');


Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


