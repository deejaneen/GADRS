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
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::get('/gym', function () {
    return view('gym');
})->name('gym');
Route::get('/dorm', function () {
    return view('dorm');
})->name('dorm');
Route::get('/logout', function () {
    return view('login');
})->name('logout');
Route::get('/login', function () {
    return view('login');
<<<<<<< Updated upstream
})->name('login');
=======
})->name('login');
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
Route::get('/adminhome', function () {
    return view('../admin/navbar/adminnav');
})->name('adminhome');

>>>>>>> Stashed changes
