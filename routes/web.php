<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DormCartController;
use App\Http\Controllers\DormController;
use App\Http\Controllers\GymCartController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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


// Routes accessible only to guests (non-authenticated users)
Route::middleware(['guest', 'preventCaching'])->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/', function () {
        return view('auth.login');
    });
});

// Routes that require authentication
Route::middleware(['auth', 'preventCaching', 'checkRole:Guest,COA Employee' ])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class)->only('show', 'edit', 'update');


    // Profile and password routes
    Route::prefix('/profile')->group(function () {
        Route::get('/account', [UserController::class, 'profile'])->name('profile');
        Route::get('/password', [UserController::class, 'showPasswordProfile'])->name('passwordprofile');
        Route::get('/reservation-history', [ProfileController::class, 'showReservationHistoryProfile'])->name('reservationhistoryprofile');
        Route::post('/updatepassword', [UserController::class, 'updatePassword'])->name('update_password');
    });

    Route::get('/dorm', [DormController::class, 'index'])->name('dorm');
    Route::post('/dorm-cart', [DormCartController::class, 'store'])->name('dorm.cart');
    Route::post('/gym-cart', [GymCartController::class, 'store'])->name('gym_cart.store');
    Route::get('/cart_check', [CartController::class, 'index'])->name('cart_check');
    Route::get('/gym', [GymController::class, 'index'])->name('gym');
    Route::post('/get-reservations', [GymController::class, 'getReservations']);
    Route::post('/cart_check/gym_convert', [CartController::class, 'GymCartToGymReservations'])->name('cart.gym_convert');
    Route::post('/cart_check/dorm_convert', [CartController::class, 'DormCartToDormReservations'])->name('cart.dorm_convert');
});

// Routes accessible only by Admin
Route::middleware(['checkRole:Admin', 'preventCaching', 'auth'])->group(function () {
    Route::get('/adminhome', [AdminController::class, 'index'])->name('adminhome');
    Route::get('/test', [AdminController::class, 'test'])->name('test');
      Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
