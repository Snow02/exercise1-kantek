<?php

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
//Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::group(['prefix' => 'admin', 'namespace' => 'Admin','middleware'=>'checkLogin'], function () {

    Route::get('index','AdminController@index')->name('admin.index');
    // Login Admin
    Route::get('/login', 'AdminController@login');
    Route::post('/login', 'AdminController@postLogin')->name('admin.login');
    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/register', 'AdminController@register')->name('admin.register');
    Route::post('/register', 'AdminController@postRegister')->name('admin.register');

    // Category
    Route::prefix('category')->group(function(){
       Route::get('index','CategoryController@getListCategory')->name('category.index');
       Route::get('add','CategoryController@addCategory')->name('category.add');
       Route::post('add','CategoryController@postAddCategory')->name('category.add');
       Route::get('edit/{id}','CategoryController@editCategory')->name('category.edit');
       Route::post('edit/{id}','CategoryController@postEditCategory')->name('category.edit');
       Route::delete('delete/{id}','CategoryController@deleteCategory')->name('category.delete');
    });
    // Product
    Route::prefix('product')->group(function(){
        Route::get('index','ProductController@getListProduct')->name('product.index');
        Route::get('add','ProductController@addProduct')->name('product.add');
        Route::post('add','ProductController@postAddProduct')->name('product.add');
        Route::delete('delete/{id}','ProductController@deleteProduct')->name('product.delete');
        Route::get('edit/{id}','ProductController@editProduct')->name('product.edit');
        Route::post('edit/{id}','ProductController@postEditProduct')->name('product.edit');

    });

});

Route::fallback(function(){
    return view('admin.404');
});
