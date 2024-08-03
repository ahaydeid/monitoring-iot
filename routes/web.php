<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Catalogcontroller;
use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class,'login']);
Route::get('/register', [LoginController::class,'register']);
Route::post('/proses_register', [LoginController::class,'store']);
Route::post('/auth/login', [LoginController::class,'proses_auth']);
Route::get('/logout', [LoginController::class,'logout']);
Route::get('/dashboard', [DashboardController::class,'index']);
Route::post('/get-tanaman', [DashboardController::class,'getData']);
Route::get('/tanaman', [DashboardController::class,'getTanaman']);
Route::post('/store-tanaman', [DashboardController::class,'store']);
Route::post('/get-detail-tanam', [DashboardController::class,'getDetail']);
Route::get('/katalog', [Catalogcontroller::class,'index']);
Route::post('/get-tanggal-panen', [Catalogcontroller::class,'getDataPanen']);
Route::post('/get-stok-panen', [Catalogcontroller::class,'getStokPanen']);
Route::post('/get-katalog', [Catalogcontroller::class,'getData']);
Route::post('/store-katalog', [Catalogcontroller::class,'store']);
Route::post('/edit-katalog', [Catalogcontroller::class,'edit']);
Route::post('/update-katalog', [Catalogcontroller::class,'update']);
Route::post('/selesai-katalog', [Catalogcontroller::class,'Pesananselesai']);
Route::post('/hapus-katalog', [Catalogcontroller::class,'destroy']);
