<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('login');
Route::post('/logout', [AuthController::class, 'handleLogout'])->name('logout');



Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');
Route::resource('patients', PatientController::class);
Route::get('/visit/create/{patient}', [PagesController::class, 'createVisit'])->name('visits.create');
Route::post('/visit/store', [PagesController::class, 'storeVisit'])->name('visits.store');
