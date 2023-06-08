<?php

use App\Http\Controllers\AccomodationDataController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationDataController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentDataController;
use App\Http\Controllers\LandlordDataController;
use App\Http\Controllers\PaymentController;
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

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

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
    });

    Route::group(['middleware' => ['tenant-register']], function(){

        Route::get('/dashboard', [DashboardController::class, 'tenantDashboard'])->name('dashboard');

        Route::get('/application/list/{status?}', function () {
            return view('application.list');
        })->where('status', '[A-Z_]+')->name('application-list');
        Route::get('/application/view/{status}/{id}', function () {
            return view('application.view');
        })->where('status', '[A-Z_]+')->name('application-view');
        
        Route::get('/loan/list/{status}', function () {
            return view('loan.list');
        })->where('status', '[A-Z_]+')->name('loan-list');
        
        Route::get('/loan/view/{status}/{id}', function () {
            return view('loan.view');
        })->where('status', '[A-Z_]+')->name('loan-view');
        
        Route::get('/invoice/list', function () {
            return view('invoice.list');
        })->name('invoice-list');
        
        Route::get('/invoice/view/{id?}', function () {
            return view('invoice.view');
        })->name('invoice-view');
        
        Route::get('/tenant/list', function () {
            return view('tenant.list');
        })->name('tenant-list');
        
        Route::get('/tenant/view/{id?}', function () {
            return view('tenant.view');
        })->name('tenant-view');
        
        Route::get('/payment/history', function () {
            return view('payment-history');
        })->name('payment-history');
        
        Route::get('/notifications', function () {
            return view('notifications');
        })->name('notifications');

        
        Route::group(['middleware' => ['user-role:ADMIN']], function(){
            Route::get('/admin/list', function () {
                return view('admin.list');
            })->name('admin-list');
            Route::get('/admin/new', function () {
                return view('admin.new');
            })->name('admin-new');
            
            Route::get('/admin/view/{id?}', function () {
                return view('admin.view');
            })->name('admin-view');

            Route::get('/settings', function () {
                return view('settings');
            })->name('settings');
        });
    });
});

// Staff Route
/* Route::group(['middleware' => ['auth', 'user-role:staff'], ['prefix', 'staff']], function()
{
    Route::get('/dashboard', [DashboardController::class, 'tenantDashboard'])->name('dashboard');
}); */

// Agent Route
/* Route::group(['middleware' => ['auth', 'user-role:agent'], ['prefix', 'agent']], function()
{
    Route::get('/dashboard', [DashboardController::class, 'tenantDashboard'])->name('dashboard');
}); */

// Super Admin Route
/* Route::group(['middleware' => ['auth', 'user-role:admin'], ['prefix', 'admin']], function()
{
    Route::get('/dashboard', [DashboardController::class, 'tenantDashboard'])->name('dashboard');
}); */
