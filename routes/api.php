<?php

use Illuminate\Support\Facades\Route; // Pastikan ini ada agar tidak error Route::
use App\Http\Controllers\Api\AwsController;
use App\Http\Controllers\Api\ArgController;

// -------------------------------------------------------------------
// 1. RUTE UNTUK NODE-RED (MENYIMPAN DATA KE DATABASE)
// Ini adalah URL yang nanti dimasukkan ke node HTTP Request di Node-RED
// -------------------------------------------------------------------
Route::post('/terima-data-aws', [AwsController::class, 'store']);
Route::post('/terima-data-arg', [ArgController::class, 'store']);


// -------------------------------------------------------------------
// 2. RUTE UNTUK WEBSITE (MENGAMBIL DATA TERBARU DARI DATABASE)
// Ini adalah URL yang akan dipanggil oleh website untuk update tampilan
// -------------------------------------------------------------------
Route::get('/aws/terbaru/{id_stasiun}', [AwsController::class, 'terbaru']);