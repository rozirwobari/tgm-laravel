<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile']);
Route::post('/profile', [App\Http\Controllers\HomeController::class, 'save_profile']);


// QC Air Baku
Route::get('/qc_air_baku', [App\Http\Controllers\AirBakuController::class, 'index']);
Route::get('/qc_air_baku/detail', [App\Http\Controllers\AirBakuController::class, 'detail']);
Route::get('/qc_air_baku/edit', [App\Http\Controllers\AirBakuController::class, 'edit']);
Route::post('/qc_air_baku/edit', [App\Http\Controllers\AirBakuController::class, 'save_edit']);
Route::post('/qc_air_baku/delete', [App\Http\Controllers\AirBakuController::class, 'delete']);

