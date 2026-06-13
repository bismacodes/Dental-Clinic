<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('login');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'handleLogout'])->name('logout');
    Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');
    Route::resource('patients', PatientController::class);
    Route::resource('visits', VisitController::class)->only(['index']);
    Route::get('/visit/create/{patient}', [PagesController::class, 'createVisit'])->name('visits.create');
    Route::post('/visit/store', [PagesController::class, 'storeVisit'])->name('visits.store');
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('password.show');
    Route::put('/change-password', [AuthController::class, 'updatePassword'])->name('password.update');
    Route::get('/logout', [AuthController::class, 'handleLogout'])->name('logout');
});