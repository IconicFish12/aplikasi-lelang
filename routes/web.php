<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\KategoriController;

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
/*
* -------------------------------------------------
    Routes Aplikasi Lelang Ibnu Syawal Aliefian
* -------------------------------------------------
*/

// Auth Routes
//Login
Route::prefix('auth')->name('auth')->group(function () {
    Route::get('/', [AuthController::class, 'userLoginView']);
    Route::post('/', [AuthController::class, 'loginAction']);
})->middleware('guest');

Route::prefix('login')->name('login')->group(function () {
    Route::get('/', [AuthController::class, 'petugasLoginView']);
    Route::post('/', [AuthController::class, 'loginAction']);
})->middleware('guest');

//Register Account
Route::prefix('register')->group(function () {
    Route::get('/', [AuthController::class, 'userRegisterview']);
    Route::post('/action', [AuthController::class, 'registerAction']);
})->middleware('guest');

Route::prefix('/registration')->group(function () {
    Route::get('/', [AuthController::class, 'petugasRegisterview']);
    Route::post('/action', [AuthController::class, 'registerAction']);
})->middleware('guest');

//Logout
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:petugas,web');

// Admin and Petugas panel
Route::prefix('/admin')->group(function () {
    Route::get('/', [BaseController::class, 'adminView'])->middleware(['auth:petugas', 'petugasAuth']);

    Route::prefix('/kategori')->middleware(['auth:petugas', 'petugasAuth'])->group(function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::post('/', [KategoriController::class, 'store']);
        Route::post('/show', [KategoriController::class, 'show']);
        Route::put('/{kategori:id}', [KategoriController::class, 'update']);
        Route::delete('/{kategori:id}', [KategoriController::class, 'destroy']);
    });

    Route::prefix('daftar-barang')->middleware(['auth:petugas', 'petugasAuth'])->group(function () {
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/', [BarangController::class, 'store']);
        Route::post('/show', [BarangController::class, 'show']);
        Route::put('/{barang:id}', [BarangController::class, 'update']);
        Route::delete('/{barang:id}', [BarangController::class, 'destroy']);
    });

    Route::prefix('outlet')->group(function () {
        Route::get('/', []);
    });

    Route::prefix('daftar-lelang')->middleware(['auth:petugas', 'petugasAuth'])->group(function () {
        Route::get('/', [LelangController::class, 'index']);
    });

    //Pegawai Profile
    Route::prefix('/me')->group(function () {
        Route::get('/', [BaseController::class, 'pegawaiProfile']);
    });
});

// User Web View
Route::prefix('/')->group(function () {
    Route::get('/', [BaseController::class, 'webView']);
});
