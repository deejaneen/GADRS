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
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

// Routes accessible only to guests 
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
Route::middleware(['auth', 'preventCaching'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Email Verification Routes
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        if ($request->isMethod('post')) {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('message', 'Verification link sent!');
        } else {
            return response('Method not allowed', 405);
        }
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');    
});

Route::middleware(['auth', 'verified', 'preventCaching', 'checkRole:Guest'])->group(function () {
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
    Route::get('/check-bed-availability', [DormController::class, 'checkBedAvailability']);
    Route::post('/dorm-cart', [DormCartController::class, 'store'])->name('dorm.cart');
    Route::post('/gym-cart', [GymCartController::class, 'store'])->name('gym_cart.store');
    Route::get('/cart_check', [CartController::class, 'index'])->name('cart_check');
    Route::get('/gym', [GymController::class, 'index'])->name('gym');
    Route::post('/get-reservations', [GymController::class, 'getReservations']);
    Route::post('/cart_check/gym_convert', [CartController::class, 'GymCartToGymReservations'])->name('cart.gym_convert');
    Route::post('/cart_check/dorm_convert', [CartController::class, 'DormCartToDormReservations'])->name('cart.dorm_convert');
    Route::delete('/cart/destroy-gym', [CartController::class, 'destroyGym'])->name('cart.destroy.gym');
    Route::delete('/cart/destroy/dorm', [CartController::class, 'destroyDorm'])->name('cart.destroy.dorm');
    Route::get('/gym/edit/{id}', [GymController::class, 'editGymReservation'])->name('gym.edit');
    Route::post('/gym/update/{id}', [GymController::class, 'updateGymReservation'])->name('gym.update');
    Route::delete('/gym/delete/{id}', [GymController::class, 'destroyGymReservation'])->name('gym.delete');

    Route::get('/dorm/edit/{id}', [DormController::class, 'editDormReservation'])->name('dorm.edit');
    Route::post('/dorm/update/{id}', [DormController::class, 'updateDormReservation'])->name('dorm.update');
    Route::delete('/dorm/delete/{id}', [DormController::class, 'destroyDormReservation'])->name('dorm.delete');
});

// Routes accessible only by Admin
Route::middleware(['auth', 'verified', 'checkRole:Admin', 'preventCaching'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'index'])->name('adminhome');
    Route::get('/test', [AdminController::class, 'test'])->name('test');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('adminusers');
    Route::delete('/admin/{id}', [AdminController::class, 'destroyUser'])->name('admin.destroyUser');
    Route::delete('/admin/reservations/{id}', [AdminController::class, 'destroyDateRestriction'])->name('admin.destroyDateRestriction');
    Route::get('/admin/reservations', [AdminController::class, 'reservations'])->name('adminreservations');
    Route::get('/admin/gym', [AdminController::class, 'gym'])->name('admingym');
    Route::get('/admin/dorm', [AdminController::class, 'dorm'])->name('admindorm');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('adminprofile');
    Route::post('/admin/reservations/restriction', [AdminController::class, 'storeDateRestriction'])->name('admin.addrestriction');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::get('/admin/users/editUser/{user}', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::post('/admin/users/createUser', [AdminController::class, 'storeUser'])->name('admin.createUser');
    Route::post('/admin/profile/password', [AdminController::class, 'updatePassword'])->name('update_password_admin');
});

// Cashier routes
Route::middleware(['auth', 'verified', 'checkRole:Cashier', 'preventCaching'])->group(function () {
    Route::get('/cashier/home', [CashierController::class, 'index'])->name('cashierhome');
    Route::get('/cashier/forpayment', [CashierController::class, 'forpayment'])->name('cashierforpayment');
    Route::get('/cashier/paid', [CashierController::class, 'paid'])->name('cashierpaid');
    Route::put('/cashier/gym/confirm/{gym}', [CashierController::class, 'confirmPaymentGym'])->name('cashier.confirmPayGym');
    Route::get('/cashier/gym/{gym}', [CashierController::class, 'editCashierGym'])->name('cashier.editCashierGym');
    Route::put('/cashier/dorm/confirm/{dorm}', [CashierController::class, 'confirmPaymentDorm'])->name('cashier.confirmPayDorm');
    Route::get('/cashier/dorm/{dorm}', [CashierController::class, 'editCashierDorm'])->name('cashier.editCashierDorm');
    Route::get('/cashier/gym/{gym}/pdf', [CashierController::class, 'viewGymPDFCashier'])->name('cashier.viewPDFGym');
    Route::get('/cashier/gym/{gym}/oodpdf', [CashierController::class, 'viewGymOrderofPaymentPDF'])->name('cashier.viewPDFOoP');
    Route::get('/cashier/dorm/{dorm}/pdf', [CashierController::class, 'viewDormPDFCashier'])->name('cashier.viewPDFDorm');
    Route::get('/cashier/profile', [CashierController::class, 'profile'])->name('cashierprofile');
    Route::post('/cashier/profile/password', [CashierController::class, 'updatePassword'])->name('update_password_cashier');
});

// Receiving routes
Route::middleware(['auth', 'verified', 'checkRole:Receiving', 'preventCaching'])->group(function () {
    Route::get('/receiving/home', [ReceivingController::class, 'index'])->name('receivinghome');
    Route::get('/receiving/pending', [ReceivingController::class, 'receivingpending'])->name('receivingpending');
    Route::get('/receiving/received', [ReceivingController::class, 'receivingreceived'])->name('receivingreceived');
    Route::get('/receiving/paid', [ReceivingController::class, 'receivingpaid'])->name('receivingpaid');
    Route::get('/receiving/gym', [ReceivingController::class, 'receivingedit'])->name('receivingeditreservations');
    Route::get('/receiving/gym/{gym}', [ReceivingController::class, 'editGym'])->name('receiving.editGym');
    Route::get('/receiving/addornumber/{gym}', [ReceivingController::class, 'addORNumber'])->name('receiving.addORNumber');
    Route::get('/receiving/addformnumberpaid/{gym}', [ReceivingController::class, 'addFormNumberPaid'])->name('receiving.addFormNumberPaid');
    Route::get('/receiving/gym/{gym}/pdf', [ReceivingController::class, 'viewGymPDF'])->name('receiving.viewPDF');
    Route::get('/receiving/gym/{gym}/oodpdf', [ReceivingController::class, 'viewGymOrderofPaymentPDF'])->name('receiving.viewPDFOoP');
    Route::put('/receiving/gym/addFormNumber/{gym}', [ReceivingController::class, 'addFormNumber'])->name('addFormNumberRec');
    Route::get('/receiving/gym/view/{gym}', [ReceivingController::class, 'viewGym'])->name('receiving.viewGym');
    Route::get('/receiving/profile', [ReceivingController::class, 'profile'])->name('receivingprofile');
    Route::post('/receiving/profile/password', [ReceivingController::class, 'updatePassword'])->name('update_password_receiving');
    
});

// Supply routes
Route::middleware(['auth', 'verified', 'checkRole:Supply', 'preventCaching'])->group(function () {
    Route::get('/supply/home', [SupplyController::class, 'index'])->name('supplyhome');
    Route::get('/supply/reservations', [SupplyController::class, 'supplyReservations'])->name('supplyreservations');
    Route::get('/supply/paid', [SupplyController::class, 'supplyPaid'])->name('supplypaid');
    Route::get('/supply/reservations/received', [SupplyController::class, 'supplyReservationsReceived'])->name('supplyreservationsrd');
    Route::get('/supply/dorm/{dorm}', [SupplyController::class, 'editDorm'])->name('supply.editDorm');
    Route::get('/supply/addornumber/{dorm}', [SupplyController::class, 'addORNumber'])->name('supply.addORNumber');
    Route::get('/supply/addformnumberpaid/{dorm}', [SupplyController::class, 'addFormNumberPaid'])->name('supply.addFormNumberPaid');
    Route::get('/supply/dorm/{dorm}/pdf', [SupplyController::class, 'viewDormPDF'])->name('supply.viewPDF');
    Route::put('/supply/dorm/addFormNumber/{dorm}', [SupplyController::class, 'addFormNumber'])->name('addFormNumber');
    Route::get('/supply/dorm/view/{dorm}', [SupplyController::class, 'viewDorm'])->name('supply.viewDorm');
    Route::get('/supply/profile', [SupplyController::class, 'profile'])->name('supplyprofile');
    Route::post('/supply/profile/password', [SupplyController::class, 'updatePassword'])->name('update_password_supply');
});

Route::get('generate-dorm-pdf', [PDFController::class, 'generatedormPDF']);
Route::get('generate-gym-pdf', [PDFController::class, 'generategymPDF']);
Route::get('/tite', function () {
    return view('pdf.OrderofPaymentGym');
});
Route::get('/tite1', function () {
    return view('loginredesign');
});

Route::get("/forget-password", [ForgetPasswordManager::class, "forgetPassword"])->name("forget.password");
Route::post("/forget-password", [ForgetPasswordManager::class, "forgetPasswordPost"])->name("forget.password.post");
Route::get("/reset-password/{token}", [ForgetPasswordManager::class, "resetPassword"])->name("reset.password");
Route::post("/reset-password", [ForgetPasswordManager::class, "resetPasswordPost"])->name("reset.password.post");

//SMTP Tester
// Route::get('/send-test-email', function () {
//     Mail::raw('This is a test email.', function ($message) {
//         $message->to('tomeldendjaninetara@gmail.com')
//                 ->subject('Test Email');
//     });

//     return 'Test email sent!';
// });

