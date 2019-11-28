<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/login','UserController@login');
    });
    Route::group(['middleware'=>'auth:api'],function() {

        // Product
        Route::group(['prefix' => 'product'], function () {
            Route::get('get-products-by-category-id/{id}','ProductController@getProductByCategoryId');
            Route::post('search-products','ProductController@searchProduct');

        });

    });

});
