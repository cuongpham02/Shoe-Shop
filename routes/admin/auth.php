<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;

Route::get('/login', [AuthController::class, 'showFormLogin'])->name('show-login');
Route::post('/login', [AuthController::class, 'Login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth:admins'])->name('logout');
