<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[App\Http\Controllers\AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[App\Http\Controllers\AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/logout',[App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/prediksi_panen',[App\Http\Controllers\PrediksiController::class, 'index'])->name('prediksi_1')->middleware('auth');
Route::get('/prediksi_benih',[App\Http\Controllers\PrediksiController::class, 'benih'])->name('prediksi_2')->middleware('auth');
Route::get('/riwayat_prediksi',[App\Http\Controllers\PrediksiController::class, 'riwayat'])->name('riwayat')->middleware('auth');



Route::view('/login', 'auth.login')->name('login'); 
