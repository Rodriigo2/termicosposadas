<?php

use App\Http\Controllers\ConnectController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\UserController;
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

Route::get('/', [ContentController::class, 'getHome'])->name('home');



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


//module user Action
Route::get('/account/edit', [UserController::class, 'getAccountEdit'])->name('account_edit');
Route::post('account/edit/avatar', [UserController::class, 'postAccountAvatar'])->name('account_avatar_edit');Route::post('account/edit/password', [UserController::class, 'postAccountPassword'])->name('account_password_edit');
Route::post('account/edit/info', [UserController::class, 'postAccountInfo'])->name('account_info_edit');