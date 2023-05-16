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
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/application/register/{id}', function () {
    return view('application.register');
})->name('application-register');

Route::get('/application/list/{status}', function () {
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


Route::get('/payment/history', function () {
    return view('payment-history');
})->name('payment-history');

Route::get('/notifications', function () {
    return view('notifications');
})->name('notifications');
