<?php
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function(){
    Route::get('/','App\Http\Controllers\Admin\DashboardController@getDashboard')->name('dashboard'); 

    //Module Users
    Route::get('/users/{status}','App\Http\Controllers\Admin\UserController@getUsers')->name('user_list');
    Route::get('/users/{id}/edit','App\Http\Controllers\Admin\UserController@getUserEdit')->name('user_edit');
    Route::get('/users/{id}/banned','App\Http\Controllers\Admin\UserController@getUserBanned')->name('user_banned');
    Route::get('/users/{id}/permissions','App\Http\Controllers\Admin\UserController@getUserPermissions')->name('user_permissions');
    Route::post('/users/{id}/permissions','App\Http\Controllers\Admin\UserController@postUserPermissions')->name('user_permissions');
    Route::post('/users/{id}/edit','App\Http\Controllers\Admin\UserController@postUserEdit')->name('user_edit');

    //Module products
    Route::get('/products/{status}','App\Http\Controllers\Admin\ProductController@getHome')->name('products');
    Route::get('/product/add','App\Http\Controllers\Admin\ProductController@getProductAdd')->name('products_add');
    Route::get('/product/{id}/edit','App\Http\Controllers\Admin\ProductController@getProductEdit')->name('products_edit');
    Route::get('/product/{id}/delete','App\Http\Controllers\Admin\ProductController@getProductDelete')->name('products_delete');
    Route::get('/product/{id}/restore','App\Http\Controllers\Admin\ProductController@getProductRestore')->name('products_restore');
    Route::post('/product/add','App\Http\Controllers\Admin\ProductController@postProductAdd')->name('products_add');
    Route::post('/product/search','App\Http\Controllers\Admin\ProductController@postProductSearch')->name('products_search');
    Route::post('/product/{id}/edit','App\Http\Controllers\Admin\ProductController@postProductEdit')->name('products_edit');
    Route::post('/product/{id}/gallery/add','App\Http\Controllers\Admin\ProductController@postProductGalleryAdd')->name('product_gallery_add');
    Route::get('/product/{id}/gallery/{gid}/delete','App\Http\Controllers\Admin\ProductController@getProductGalleryDelete')->name('product_gallery_delete');


    //Categories
    Route::get('/categories/{module}', 'App\Http\Controllers\Admin\CategoriesController@getHome')->name('categories');
    Route::post('/category/add', 'App\Http\Controllers\Admin\CategoriesController@postCategoryAdd')->name('category_add');
    Route::get('/category/{id}/edit', 'App\Http\Controllers\Admin\CategoriesController@getCategoryEdit')->name('category_edit');
    Route::post('/category/{id}/edit', 'App\Http\Controllers\Admin\CategoriesController@postCategoryEdit')->name('category_edit');
    Route::get('/category/{id}/delete', 'App\Http\Controllers\Admin\CategoriesController@getCategoryDelete')->name('category_delete');
});
?>