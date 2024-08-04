<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Catalogcontroller;
use App\Http\Controllers\TanamanController;
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

Route::get('/login', [LoginController::class,'login'])->name('login');
Route::get('/register', [LoginController::class,'register']);
Route::post('/proses_register', [LoginController::class,'store']);
Route::post('/auth/login', [LoginController::class,'proses_auth']);
Route::get('/logout', [LoginController::class,'logout']);
Route::post('/auto-load-data', [DashboardController::class,'autoLoad'])->middleware('auth');
Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth');
Route::post('/get-tanaman', [DashboardController::class,'getData'])->middleware('auth');
Route::get('/tanaman', [DashboardController::class,'getTanaman'])->middleware('auth');
Route::post('/store-tanaman', [DashboardController::class,'store'])->middleware('auth');
Route::post('/get-detail-tanam', [DashboardController::class,'getDetail'])->middleware('auth');
Route::get('/katalog', [Catalogcontroller::class,'index'])->middleware('auth');
Route::post('/get-tanggal-panen', [Catalogcontroller::class,'getDataPanen'])->middleware('auth');
Route::post('/get-stok-panen', [Catalogcontroller::class,'getStokPanen'])->middleware('auth');
Route::post('/get-katalog', [Catalogcontroller::class,'getData'])->middleware('auth');
Route::post('/store-katalog', [Catalogcontroller::class,'store'])->middleware('auth');
Route::post('/edit-katalog', [Catalogcontroller::class,'edit'])->middleware('auth');
Route::post('/update-katalog', [Catalogcontroller::class,'update'])->middleware('auth');
Route::post('/selesai-katalog', [Catalogcontroller::class,'Pesananselesai'])->middleware('auth');
Route::post('/hapus-katalog', [Catalogcontroller::class,'destroy'])->middleware('auth');
Route::get('/master-jenis-sayur', [TanamanController::class,'index'])->middleware('auth');
Route::post('/get-jenis-sayur', [TanamanController::class,'getData'])->middleware('auth');
Route::post('/store-jenis-sayur', [TanamanController::class,'store'])->middleware('auth');
Route::post('/edit-jenis-sayur', [TanamanController::class,'edit'])->middleware('auth');
Route::post('/update-jenis-sayur', [TanamanController::class,'update'])->middleware('auth');
Route::post('/hapus-jenis-sayur', [TanamanController::class,'destroy'])->middleware('auth');
