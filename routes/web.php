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

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/application/list/{status}', function () {
    return view('application.list');
})->where('status', '[A-Z]+')->name('application-list');

Route::get('/application/view/{status}/{id?}', function () {
    return view('application.view');
})->name('application-view');

Route::get('/loan/list', function () {
    return view('loan.list');
})->name('loan-list');

Route::get('/loan/view/{id?}', function () {
    return view('loan.view');
})->name('loan-view');


Route::get('/payment/history', function () {
    return view('payment-history');
})->name('payment-history');

Route::get('/notifications', function () {
    return view('notifications');
})->name('notifications');
