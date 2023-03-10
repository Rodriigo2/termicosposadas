<?php

use App\Http\Controllers\ConnectController;
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

Route::get('/', function () {
    return view('welcome');
});


//Routers AUTH

Route::get('/login', [ConnectController::class, 'getLogin'])->name('login');
Route::post('/login', [ConnectController::class, 'postlogin'])->name('login');
Route::get('/recover', [ConnectController::class, 'getRecover'])->name('recover');
Route::post('/recover', [ConnectController::class, 'postRecover'])->name('recover');
Route::get('/reset', [ConnectController::class, 'getReset'])->name('reset');
Route::post('/reset', [ConnectController::class, 'postReset'])->name('reset');
Route::get('/register', [ConnectController::class, 'getRegister'])->name('register');
Route::post('/register', [ConnectController::class, 'postRegister'])->name('register');
Route::get('/logout', [ConnectController::class, 'getLogout'])->name('logout');