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
    Route::resource('/customer-to-group', App\Http\Controllers\CustomerGroupController::class)->except(['create','show','edit']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
