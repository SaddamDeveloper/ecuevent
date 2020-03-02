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

Route::get('/admin/login', 'Admin\AdminLoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\AdminLoginController@adminLogin');
Route::post('/admin/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');

Route::group(['middleware'=>'auth:admin','prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/dashboard', 'AdminDashboardController@index')->name('admin.dashboard');

    Route::group(['prefix'  =>  'member'], function(){
        Route::get('/product', 'MemberProductController@memProductList')->name('admin.mem_product_list');
        Route::get('/add/product', 'MemberProductController@memAddProductForm')->name('admin.mem_add_product_form');
        Route::post('/add/new/product', 'MemberProductController@memAddNewProduct')->name('admin.mem_add_new_product');
    }); 
});
