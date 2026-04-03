<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BitcoinController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('bitcoin.index');
});


Route::middleware(['auth'])->group(function(){
    Route::controller(BitcoinController::class)->group(function(){
        Route::get('/bitcoin', 'index')->name('bitcoin.index');
        Route::post('/bitcoin', 'updateConfig')->name('bitcoin.updateConfig');
    });
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'indexLogin')->name('login.index');
    Route::get('/logout', 'logout');
    Route::post('/login', 'login')->name('login');
    Route::get('/register', 'indexRegister')->name('register.index');
    Route::post('/register', 'register')->name('register');
});