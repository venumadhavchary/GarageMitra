<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobcardsController as Jobcards;
use App\Http\Controllers\MechanicsController;
use App\Http\Controllers\VehiclesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('guest')->group(function () {
    
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('send_otp', [AuthController::class, 'sendOtp'])->name('auth.send_otp');
    Route::post('resend_otp', [AuthController::class, 'resendOtp'])->name('auth.resend_otp');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('change_number', [AuthController::class, 'changeNumber'])->name('change_number');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'store'])->name('auth.store');

});
 
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function ()  {
        return view('dashboard');
    })->name('dashboard');    
    Route::resource('mechanics', MechanicsController::class);
    Route::get('jobcards', [Jobcards::class, 'index'] )->name('jobcards.index');
    Route::resource('vehicles', VehiclesController::class);
});

