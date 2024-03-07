<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('pages.index');
});

Route::match(['get', 'post'], '/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::resource('/sewa-mobil', App\Http\Controllers\SewaMobilController::class)->names('sewa-mobil');

Route::middleware('auth')->group(function () {
    Route::match(['get', 'put'], 'profil', [App\Http\Controllers\ProfilController::class, 'index'])->name('profil');
    Route::put('profil/password', [App\Http\Controllers\ProfilController::class, 'updatePassword'])->name('profil.password');
    Route::resource('/mobil', App\Http\Controllers\MobilController::class)->names('mobil');
    Route::resource('/peminjaman', App\Http\Controllers\PeminjamanController::class)->names('peminjaman');
    Route::resource('/pengembalian', App\Http\Controllers\PengembalianController::class)->names('pengembalian');
});
