<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/customer', App\Http\Controllers\CustomerController::class)->except(['create','show','edit']);
    Route::resource('/group', App\Http\Controllers\GroupController::class)->except(['create','show','edit']);
    Route::resource('/template', App\Http\Controllers\TemplateController::class)->except(['create','show','edit']);
    Route::resource('/customer-to-group', App\Http\Controllers\CustomerGroupController::class)->except(['create','show','edit']);
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/dashboard/send-email', [App\Http\Controllers\MailController::class, 'sendMassMail'])->name('mail.send');
    Route::post('/dashboard/schedule-email', [App\Http\Controllers\MailController::class, 'scheduleMail'])->name('mail.schedule');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
