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

//Module Cart
Route::get('/cart', 'App\Http\Controllers\CartController@getCart')->name('cart');
Route::post('/cart/product/{id}/add', 'App\Http\Controllers\CartController@postCartAdd')->name('cart_add');
Route::post('/cart/item/{id}/update', 'App\Http\Controllers\CartController@postCartItemQuantityUpdate')->name('cart_item_update');
Route::get('/cart/item/{id}/delete', 'App\Http\Controllers\CartController@getCartItemDelete')->name('cart_item_delete');

//Module Store
Route::get('/store', 'App\Http\Controllers\StoreController@getStore')->name('store');
Route::get('/store/category/{id}/{slug}', 'App\Http\Controllers\StoreController@getCategory')->name('store_category');
Route::post('/search', 'App\Http\Controllers\StoreController@postSearch')->name('search');

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

//Module Products
Route::get('/product/{id}/{slug}', 'App\Http\Controllers\ProductController@getProduct')->name('product_single');


//module user Action
Route::get('/account/edit', [UserController::class, 'getAccountEdit'])->name('account_edit');
Route::post('account/edit/avatar', [UserController::class, 'postAccountAvatar'])->name('account_avatar_edit');Route::post('account/edit/password', [UserController::class, 'postAccountPassword'])->name('account_password_edit');
Route::post('account/edit/info', [UserController::class, 'postAccountInfo'])->name('account_info_edit');
Route::get('/account/address', [UserController::class, 'getAccountAddress'])->name('account_address');
Route::post('/account/address/add', [UserController::class, 'postAccountAddressAdd'])->name('account_address');
Route::get('/account/address/{address}/setdefault', [UserController::class, 'getAccountAddressSetDefault'])->name('account_address');
Route::get('/account/address/{address}/delete', [UserController::class, 'getAccountAddressDelete'])->name('account_address');

//Ajax API Routers
Route::get('/md/api/load/products/{section}', ['uses' => 'App\Http\Controllers\ApiJsController@getProductsSection'])->name('products_section');
Route::post('/md/api/favorites/add/{object}/{module}', ['uses' => 'App\Http\Controllers\ApiJsController@postFavoriteAdd']);
Route::post('/md/api/load/user/favorites', ['uses' => 'App\Http\Controllers\ApiJsController@postUserFavorites']);
Route::post('/md/api/load/product/inventory/{inv}/variants', ['uses' => 'App\Http\Controllers\ApiJsController@postProductInventoryVariants']);
Route::post('/md/api/load/cities/{state}', ['uses' => 'App\Http\Controllers\ApiJsController@postCoverageCitiesFromState']);
