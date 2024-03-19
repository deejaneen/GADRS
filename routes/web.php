<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\UserController;

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


Route::get('/dorm', function () {
    return view('dorm');
})->name('dorm');


Route::get('/reservationhistoryprofile', function () {
    return view('../profile/reservationhistoryprofile');
})->name('reservationhistoryprofile');
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/adminhome', function () {
    return view('../admin/navbar/adminnav');
})->name('home');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cart_check', function () {
    return view('cart_checkout');
})->name('cart_check');


Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::get('/passwordprofile', function () {
    return view('profile.passwordprofile');
})->name('passwordprofile');

Route::post('/passwordprofile/update-password', [UserController::class, 'updatePassword'])->name('update_password');

Route::get('/gym', function () {
    return view('gym');
})->name('gym');


Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.add');
