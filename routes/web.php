<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseController;

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
Route::prefix('register')->group(function (){
    Route::get('/', [AuthController::class, 'userRegisterview']);
    Route::post('/action', [AuthController::class, 'registerAction']);
})->middleware('guest');

Route::prefix('/registration')->group(function (){
    Route::get('/', [AuthController::class, 'petugasRegisterview']);
    Route::post('/action', [AuthController::class, 'registerAction']);
})->middleware('guest');

//Logout
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:petugas,web');

// Admin and Petugas panel
Route::prefix('/admin')->group(function(){
    Route::get('/', [BaseController::class, 'adminView'])->middleware('petugasAuth');
})->middleware(['auth:petugas']);

// User Web View
Route::prefix('/')->group(function(){
    Route::get('/', [BaseController::class, 'webView']);
});
