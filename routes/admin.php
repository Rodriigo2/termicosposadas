<?php
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function(){
    Route::get('/','App\Http\Controllers\Admin\DashboardController@getDashboard')->name('dashboard'); 

    //Module Settings
    Route::get('/settings','App\Http\Controllers\Admin\SettingsController@getHome')->name('settings');
    Route::post('/settings','App\Http\Controllers\Admin\SettingsController@postHome')->name('settings');
    

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
    Route::get('/product/{id}/inventory','App\Http\Controllers\Admin\ProductController@getProductInventory')->name('products_inventory');
    Route::post('/product/add','App\Http\Controllers\Admin\ProductController@postProductAdd')->name('products_add');
    Route::post('/product/search','App\Http\Controllers\Admin\ProductController@postProductSearch')->name('products_search');
    Route::post('/product/{id}/edit','App\Http\Controllers\Admin\ProductController@postProductEdit')->name('products_edit');
    Route::post('/product/{id}/inventory','App\Http\Controllers\Admin\ProductController@postProductInventory')->name('products_inventory');
    Route::post('/product/{id}/gallery/add','App\Http\Controllers\Admin\ProductController@postProductGalleryAdd')->name('product_gallery_add');
    Route::get('/product/{id}/gallery/{gid}/delete','App\Http\Controllers\Admin\ProductController@getProductGalleryDelete')->name('product_gallery_delete');


    //Module Inventory
    Route::get('/product/inventory/{id}/edit', 'App\Http\Controllers\Admin\ProductController@getProductInventoryEdit')->name('products_inventory');
    Route::post('/product/inventory/{id}/edit', 'App\Http\Controllers\Admin\ProductController@postProductInventoryEdit')->name('products_inventory');
    Route::post('/product/inventory/{id}/variant', 'App\Http\Controllers\Admin\ProductController@postProductInventoryVariantAdd')->name('products_inventory');
    Route::get('/product/inventory/{id}/delete', 'App\Http\Controllers\Admin\ProductController@getProductInventoryDelete')->name('products_inventory');
    Route::get('/product/variant/{id}/delete', 'App\Http\Controllers\Admin\ProductController@getProductInventoryVariantDelete')->name('products_inventory');

    //Categories
    Route::get('/categories/{module}', 'App\Http\Controllers\Admin\CategoriesController@getHome')->name('categories');
    Route::post('/category/add/{module}', 'App\Http\Controllers\Admin\CategoriesController@postCategoryAdd')->name('category_add');
    Route::get('/category/{id}/edit', 'App\Http\Controllers\Admin\CategoriesController@getCategoryEdit')->name('category_edit');
    Route::get('/category/{id}/subs', 'App\Http\Controllers\Admin\CategoriesController@getSubCategories')->name('category_edit');
    Route::post('/category/{id}/edit', 'App\Http\Controllers\Admin\CategoriesController@postCategoryEdit')->name('category_edit');
    Route::get('/category/{id}/delete', 'App\Http\Controllers\Admin\CategoriesController@getCategoryDelete')->name('category_delete');


    //Sliders
    Route::get('/sliders', 'App\Http\Controllers\Admin\SlidersController@getHome')->name('sliders_list');
    Route::post('/slider/add', 'App\Http\Controllers\Admin\SlidersController@postSliderAdd')->name('sliders_add');
    Route::get('/slider/{id}/edit', 'App\Http\Controllers\Admin\SlidersController@getEditSlider')->name('sliders_edit');
    Route::post('/slider/{id}/edit', 'App\Http\Controllers\Admin\SlidersController@postEditSlider')->name('sliders_edit');
    Route::get('/slider/{id}/delete', 'App\Http\Controllers\Admin\SlidersController@getDeleteSlider')->name('sliders_delete');


    //Coverage
    Route::get('/coverage', 'App\Http\Controllers\Admin\CoverageController@getList')->name('coverage_list');
    Route::post('/coverage/state/add', 'App\Http\Controllers\Admin\CoverageController@postCoverageStateAdd')->name('coverage_add');
    Route::post('/coverage/city/add', 'App\Http\Controllers\Admin\CoverageController@postCoverageCityAdd')->name('coverage_add');
    Route::get('/coverage/{id}/edit', 'App\Http\Controllers\Admin\CoverageController@getCoverageEdit')->name('coverage_edit');
    Route::get('/coverage/city/{id}/edit', 'App\Http\Controllers\Admin\CoverageController@getCoverageCityEdit')->name('coverage_edit');
    Route::post('/coverage/city/{id}/edit', 'App\Http\Controllers\Admin\CoverageController@postCoverageCityEdit')->name('coverage_edit');
    Route::post('/coverage/state/{id}/edit', 'App\Http\Controllers\Admin\CoverageController@postCoverageStateEdit')->name('coverage_edit');
    Route::get('/coverage/{id}/cities', 'App\Http\Controllers\Admin\CoverageController@getCoverageCities')->name('coverage_list');
    Route::get('/coverage/{id}/delete', 'App\Http\Controllers\Admin\CoverageController@getCoverageDelete')->name('coverage_delete');

    // Javascript Request
    Route::get('/md/api/load/subcategories/{parent}', ['uses' => 'App\Http\Controllers\Admin\ApiController@getSubCategories']);
});
?>