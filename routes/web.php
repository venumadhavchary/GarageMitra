<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobcardsController;
use App\Http\Controllers\MechanicsController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;


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
    Route::get('/jobcards', [JobcardsController::class, 'index'])->name('jobcards.index');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('jobcards/{id}', [JobcardsController::class, 'show'])->name('jobcards.show');
    Route::get('jobcards/{vehicle_id}/create', [JobcardsController::class, 'create'])->name('jobcards.create');
    Route::put('jobcards/{id}/update', [JobcardsController::class, 'update'])->name('jobcards.update');
    Route::post('jobcards/{vehicle_id}', [JobcardsController::class, 'store'])->name('jobcards.store');
    Route::get('vehicles/{id}', [VehiclesController::class, 'showJobs'])->name('vehicles.show');
    
    Route::get('bill/{jobcard_id}/generate', [BillController::class, 'generateBill'])->name('bills.generate');
    Route::post('bill/{jobcard_id}/store',[BillController::class, 'store'])->name('bills.store');
    Route::get('bill/{id}/show',[BillController::class, 'show'])->name('bills.show');
    Route::put('bill/{id}/update',[BillController::class, 'update'])->name('bills.update');
    Route::get('docs', function () {
        return view('docs');
    })->name('docs');
    // Main Resources
    // Route::resource('jobcards', JobcardsController::class);
    Route::resource('mechanics', MechanicsController::class);
    Route::resource('vehicles', VehiclesController::class);

});

