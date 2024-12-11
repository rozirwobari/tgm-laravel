<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile']);
Route::post('/profile', [App\Http\Controllers\HomeController::class, 'save_profile']);


// QC Air Baku
Route::get('/qc_air_baku', [App\Http\Controllers\AirBakuController::class, 'index'])->name('qc_air_baku');
Route::get('/qc_air_baku/input', [App\Http\Controllers\AirBakuController::class, 'create']);
Route::get('/qc_air_baku/detail/{id}', [App\Http\Controllers\AirBakuController::class, 'show']);
Route::get('/qc_air_baku/delete/{id}', [App\Http\Controllers\AirBakuController::class, 'destroy']);
Route::get('/qc_air_baku/reject/{id}', [App\Http\Controllers\AirBakuController::class, 'reject']);
Route::get('/qc_air_baku/approve/{id}', [App\Http\Controllers\AirBakuController::class, 'approve']);

Route::post('/qc_air_baku/edit/{id}', [App\Http\Controllers\AirBakuController::class, 'update']);
Route::post('/qc_air_baku/input', [App\Http\Controllers\AirBakuController::class, 'store']);


