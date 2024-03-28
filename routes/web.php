<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DormCartController;
use App\Http\Controllers\GymCartController;
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
})->name('adminhome');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/cart_check/gym_convert', [CartController::class, 'GymCartToGymReservations'])->name('cart.gym_convert');
Route::post('/cart_check/dorm_convert', [CartController::class, 'DormCartToDormReservations'])->name('cart.dorm_convert');


// Route::post('/cart_check/dorm_convert', 'CartController@DormCartToDormReservations')->name('cart.dorm_convert');

// Route::post('/cart_check/gym_convert', 'CartController@GymCartToGymReservations')->name('cart.gym_convert');


Route::get('/newlogin', function () {
    return view('auth.newlogin');
})->name('newlogin');
Route::get('/newregister', function () {
    return view('auth.newregister');
})->name('newregister');

Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::get('/passwordprofile', function () {
    return view('profile.passwordprofile');
})->name('passwordprofile');

Route::post('/passwordprofile/update-password', [UserController::class, 'updatePassword'])->name('update_password');



Route::post('/gym-cart', [GymCartController::class, 'store'])->name('gym_cart.store');
Route::get('/cart_check', [CartController::class, 'index'])->name('cart_check');

Route::get('/gym', [GymController::class, 'index'])->name('gym');
Route::post('/get-reservations', [GymController::class, 'getReservations']);

Route::post('/dorm', [DormCartController::class, 'store'])->name('dorm.cart');
