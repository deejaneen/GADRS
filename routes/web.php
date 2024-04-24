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
use App\Http\Controllers\ReceivingController;
use App\Http\Controllers\CashierController;
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
    // Route::post('/cart_check/form', [CartController::class, 'GymCartToGymReservations'])->name('cart.gym_form');
    // Route::post('/cart/gym_convert', 'CartController@GymCartToGymReservations')->name('cart.gym_convert');

});

// Routes accessible only by Admin
Route::middleware(['checkRole:Admin', 'preventCaching', 'auth'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'index'])->name('adminhome');
    Route::get('/test', [AdminController::class, 'test'])->name('test');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('adminusers');
    Route::get('/admin/reservations', [AdminController::class, 'reservations'])->name('adminreservations');
    Route::get('/admin/gym', [AdminController::class, 'gym'])->name('admingym');
    Route::get('/admin/dorm', [AdminController::class, 'dorm'])->name('admindorm');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('adminprofile');
      Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


//cashier
Route::get('/cashier/home', [CashierController::class, 'index'])->name('cashierhome');
Route::get('/cashier/forpayment', [CashierController::class, 'forpayment'])->name('cashierforpayment');
Route::get('/cashier/paid', [CashierController::class, 'paid'])->name('cashierpaid');


//receiving
Route::get('/receiving/home', [ReceivingController::class, 'index'])->name('receivinghome');
Route::get('/test', [ReceivingController::class, 'test'])->name('test');
Route::get('/receiving/users', [ReceivingController::class, 'users'])->name('receivingusers');
Route::get('/receiving/reservations', [ReceivingController::class, 'reservations'])->name('receivingreservations');
Route::get('/receiving/gym', [ReceivingController::class, 'gym'])->name('receivinggym');
Route::get('/receiving/dorm', [ReceivingController::class, 'dorm'])->name('receivingdorm');
Route::get('/receiving/profile', [ReceivingController::class, 'profile'])->name('receivingprofile');
