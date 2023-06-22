<?php

use App\Http\Controllers\AccomodationDataController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationDataController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentDataController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LandlordDataController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UsersController;
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
    return view('home');
})->name('home');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.user');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/signup', [SignupController::class, 'show'])->name('signup');
Route::post('/signup/otp', [SignupController::class, 'getOTP'])->name('signup-otp');
Route::post('/signup', [SignupController::class, 'signup'])->name('signup-user');

Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot-password');

Route::get('/reset-password', function () {
    return view('reset-password');
})->name('reset-password');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

// Tenant Route
/* Route::group(['middleware' => ['auth', 'user-role:TENANT'], ['prefix', 'tenant']], function()
{
    Route::get('/dashboard', [DashboardController::class, 'tenantDashboard'])->name('dashboard');
}); */
Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['user-role:TENANT']], function(){
        Route::get('/application/register/{id}', [ApplicationController::class, 'showRegistrationForm'])->name('application-register');
        Route::put('/application/register/applicationData', [ApplicationDataController::class, 'update'])->name('applicationData-update');
        Route::put('/application/register/accomodationData', [AccomodationDataController::class, 'update'])->name('accomodationData-update');
        Route::post('/application/register/documentData', [DocumentDataController::class, 'update'])->name('documentData-update');
        Route::put('/application/register/landlordData', [LandlordDataController::class, 'update'])->name('landlordData-update');
        Route::post('/application/register/payment', [PaymentController::class, 'payRegistrationFees'])->name('application-payment');
        Route::post('/application/initialDeposit', [PaymentController::class, 'payInitialDeposit'])->name('application-initialDeposit');
        Route::post('/application/reapply', [ApplicationController::class, 'reapply'])->name('application-reapply');

        Route::post('/loan/payment', [PaymentController::class, 'payRent'])->name('loan-payment');
    });

    Route::group(['middleware' => ['user-role:STAFF']], function(){
        //
    });

    Route::group(['middleware' => ['user-role:AGENT']], function(){
        //
    });

    Route::group(['middleware' => ['user-role:ADMIN']], function(){
        Route::post('/application/assignStaff', [ApplicationController::class, 'assignStaff'])->name('application-assignStaff');
        Route::post('/application/reject', [ApplicationController::class, 'reject'])->name('application-reject');
        Route::post('/application/approve', [ApplicationController::class, 'approve'])->name('application-approve');

        Route::get('/tenant/list', [UsersController::class, 'tenantIndex'])->name('tenant-list');
        Route::get('/tenant/view/{id?}', [UsersController::class, 'tenantView'])->name('tenant-view');

        Route::get('/subadmin/list', [UsersController::class, 'subadminIndex'])->name('subadmin-list');
        Route::post('/subadmin/new', [UsersController::class, 'subadminNew'])->name('subadmin-new');
        Route::get('/subadmin/view/{id?}', [UsersController::class, 'subadminView'])->name('subadmin-view');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings/update', [SettingController::class, 'update'])->name('settings-update');
    });

    Route::group(['middleware' => ['tenant-register']], function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/application/list/{status?}', [ApplicationController::class, 'index'])->name('application-list');
        Route::get('/application/view/{id}', [ApplicationController::class, 'view'])->name('application-view');
        Route::post('/application/sendForApproval', [ApplicationController::class, 'sendForApproval'])->name('application-sendForApproval');
        Route::post('/application/loan', [LoanController::class, 'new'])->name('application-loan');
        
        Route::get('/loan/list/{status?}', [LoanController::class, 'index'])->name('loan-list');
        Route::get('/loan/view/{id}', [LoanController::class, 'view'])->name('loan-view');
        Route::post('/loan/offlinePayment', [PaymentController::class, 'payRentOffline'])->name('loan-offlinePayment');
        
        
        Route::get('/invoice/list', [InvoiceController::class, 'index'])->name('invoice-list');
        Route::get('/invoice/view/{id?}', [InvoiceController::class, 'view'])->name('invoice-view');
        
        Route::get('/payment/list', [PaymentController::class, 'index'])->name('payment-list');
        Route::get('/payment/outstanding', [PaymentController::class, 'outstanding'])->name('payment-outstanding');
        Route::get('/payment/accept', [PaymentController::class, 'accept'])->name('payment-accept');

        Route::get('/payment/history', function () {
            return view('payment-history');
        })->name('payment-history');
        
        Route::get('/notifications', function () {
            return view('notifications');
        })->name('notifications');
    });
});