<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\Api\AwsController; 
use App\Http\Controllers\Api\ArgController;

// ==========================================
// RUTE AUTENTIKASI (LOGIN & REGISTER)
// ==========================================
Route::get('/', function () { return view('login'); });
Route::get('/register', function () { return view('register'); });
Route::post('/register', [AuthController::class, 'registerPost']);
Route::post('/login', [AuthController::class, 'loginPost']);

// ==========================================
// RUTE HOME UMUM
// ==========================================
Route::get('/home', function () { return view('home'); });

// ==========================================
// RUTE DASHBOARD CUACA (Peta & Detail Sensor)
// ==========================================

// 1. Menampilkan Peta Interaktif (Halaman Utama Dashboard)
Route::get('/dashboard', [DashboardController::class, 'index']);


// 2. Menampilkan Kotak Sensor (Saat bulatan di peta diklik)
Route::get('/dashboard/detail/{id_alat}', [DashboardController::class, 'detail']);

// Rute untuk halaman Menu Data
Route::get('/data', [DashboardController::class, 'halamanData']);
