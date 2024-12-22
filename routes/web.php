<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile']);
Route::post('/profile', [App\Http\Controllers\HomeController::class, 'save_profile']);
Route::get('/manage_user', [App\Http\Controllers\ManageUserController::class, 'index'])->name('manage_user');
Route::get('/edit_account/{id}', [App\Http\Controllers\ManageUserController::class, 'show']);
Route::post('/save_account/{id}', [App\Http\Controllers\ManageUserController::class, 'update']);
Route::get('/export_all_excel', [App\Http\Controllers\HomeController::class, 'exportAllExcel']);

// QC Air Baku
Route::get('/qc_air_baku', [App\Http\Controllers\AirBakuController::class, 'index'])->name('qc_air_baku');
Route::get('/qc_air_baku/input', [App\Http\Controllers\AirBakuController::class, 'create']);
Route::get('/qc_air_baku/detail/{id}', [App\Http\Controllers\AirBakuController::class, 'show']);
Route::get('/qc_air_baku/delete/{id}', [App\Http\Controllers\AirBakuController::class, 'destroy']);
Route::get('/qc_air_baku/reject/{id}', [App\Http\Controllers\AirBakuController::class, 'reject']);
Route::get('/qc_air_baku/approve/{id}', [App\Http\Controllers\AirBakuController::class, 'approve']);
Route::post('/qc_air_baku/edit/{id}', [App\Http\Controllers\AirBakuController::class, 'update']);
Route::post('/qc_air_baku/input', [App\Http\Controllers\AirBakuController::class, 'store']);
Route::get('/qc_air_baku/export', [App\Http\Controllers\AirBakuController::class, 'export']);


// QC Air Botol
Route::get('/qc_air_botol', [App\Http\Controllers\AirBotolController::class, 'index'])->name('qc_air_botol');
Route::get('/qc_air_botol/input', [App\Http\Controllers\AirBotolController::class, 'create']);
Route::get('/qc_air_botol/detail/{id}', [App\Http\Controllers\AirBotolController::class, 'show']);
Route::get('/qc_air_botol/delete/{id}', [App\Http\Controllers\AirBotolController::class, 'destroy']);
Route::get('/qc_air_botol/reject/{id}', [App\Http\Controllers\AirBotolController::class, 'reject']);
Route::get('/qc_air_botol/approve/{id}', [App\Http\Controllers\AirBotolController::class, 'approve']);
Route::post('/qc_air_botol/edit/{id}', [App\Http\Controllers\AirBotolController::class, 'update']);
Route::post('/qc_air_botol/input', [App\Http\Controllers\AirBotolController::class, 'store']);
Route::get('/qc_air_botol/export', [App\Http\Controllers\AirBotolController::class, 'export']);


// QC Air Cup
Route::get('/qc_air_cup', [App\Http\Controllers\AirCupController::class, 'index'])->name('qc_air_cup');
Route::get('/qc_air_cup/input', [App\Http\Controllers\AirCupController::class, 'create']);
Route::get('/qc_air_cup/detail/{id}', [App\Http\Controllers\AirCupController::class, 'show']);
Route::get('/qc_air_cup/delete/{id}', [App\Http\Controllers\AirCupController::class, 'destroy']);
Route::get('/qc_air_cup/reject/{id}', [App\Http\Controllers\AirCupController::class, 'reject']);
Route::get('/qc_air_cup/approve/{id}', [App\Http\Controllers\AirCupController::class, 'approve']);
Route::post('/qc_air_cup/edit/{id}', [App\Http\Controllers\AirCupController::class, 'update']);
Route::post('/qc_air_cup/input', [App\Http\Controllers\AirCupController::class, 'store']);
Route::get('/qc_air_cup/export', [App\Http\Controllers\AirCupController::class, 'export']);


// QC Air Galon
Route::get('/qc_air_galon', [App\Http\Controllers\AirGalonController::class, 'index'])->name('qc_air_galon');
Route::get('/qc_air_galon/input', [App\Http\Controllers\AirGalonController::class, 'create']);
Route::get('/qc_air_galon/detail/{id}', [App\Http\Controllers\AirGalonController::class, 'show']);
Route::get('/qc_air_galon/delete/{id}', [App\Http\Controllers\AirGalonController::class, 'destroy']);
Route::get('/qc_air_galon/reject/{id}', [App\Http\Controllers\AirGalonController::class, 'reject']);
Route::get('/qc_air_galon/approve/{id}', [App\Http\Controllers\AirGalonController::class, 'approve']);
Route::post('/qc_air_galon/edit/{id}', [App\Http\Controllers\AirGalonController::class, 'update']);
Route::post('/qc_air_galon/input', [App\Http\Controllers\AirGalonController::class, 'store']);
Route::get('/qc_air_galon/export', [App\Http\Controllers\AirGalonController::class, 'export']);
