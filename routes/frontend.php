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

// ========== Index =========
Route::get('/', function () {
    return view('web.index');
})->name('web.index');

// ========== Register =========
Route::group(['prefix'=>'web', 'namespace'=> 'Web'],function(){
    // Register
    Route::get('/register', 'UsersController@registerForm')->name('web.register');
    Route::post('/add/user', 'UsersController@addUser')->name('web.add_user');
    
    // Login
    Route::get('/login', 'UsersController@loginForm')->name('web.login');
    Route::post('/do/login', 'UsersController@doLogin')->name('web.do_login');
    Route::post('/logout', 'UsersController@logout')->name('web.logout');
});

// ========== Product =========
Route::get('/Product-List', function () {
    return view('web.product.product-list');
})->name('web.product.product-list');

// ========== Product-Detail =========
Route::get('/Product-Detail', function () {
    return view('web.product.product-detail');
})->name('web.product.product-detail');
>>>>>>> update
