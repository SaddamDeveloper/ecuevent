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

/***
 * Admin Login Control
 */
Route::get('/admin/login', 'Admin\AdminLoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\AdminLoginController@adminLogin');
Route::post('/admin/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');

/***
 * Member Login Control
 */
Route::get('/member/login', 'Member\MemberLoginController@showMemberLoginForm')->name('member.login');
Route::post('/member/login', 'Member\MemberLoginController@memberLogin');
Route::post('/member/logout', 'Member\MemberLoginController@logout')->name('member.logout');

Route::group(['middleware'=>'auth:admin','prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/dashboard', 'AdminDashboardController@index')->name('admin.dashboard');

    /***
     * Epin GENERATE Control
     */
    Route::get('/epin', 'EpinController@memEpinList')->name('admin.mem_epin');
    Route::get('/add/epin', 'EpinController@memAddEpinForm')->name('admin.mem_add_epin_form');
    Route::post('/add/new/epin', 'EpinController@memAddGenerateEpin')->name('admin.mem_add_generate_epin');
    Route::get('/ajax/get/epin/','EpinController@ajaxGetEpinList')->name('admin.ajax.get_epin_list');
    
    /***
     * Epin Allot Control
     */
    Route::get('/allot/epin', 'EpinAllotController@memAllotEpinForm')->name('admin.mem_allot_epin_form');
    
    /***
     * Member Macthing Income Control
     */
    Route::get('/matching/income', 'MatchingIncomeController@memMatchingIncomeForm')->name('admin.mem_matching_income');
    Route::post('/add/matching/income', 'MatchingIncomeController@memAddMatchingIncome')->name('admin.mem_add_matching_income');

    /***
     * Member Prdouct Control
     */
    Route::group(['prefix'  =>  'member'], function(){
        Route::get('/product', 'MemberProductController@memProductList')->name('admin.mem_product_list');
        Route::get('/add/product', 'MemberProductController@memAddProductForm')->name('admin.mem_add_product_form');
        Route::post('/add/new/product', 'MemberProductController@memAddNewProduct')->name('admin.mem_add_new_product');
        Route::get('/edit/product/{id}', 'MemberProductController@editMemberProduct')->name('admin.edit_member_product');
        Route::post('/update/product/', 'MemberProductController@updateMemberProduct')->name('admin.mem_update_new_product');
        Route::get('/delete/product/{id}', 'MemberProductController@deleteMemberProduct')->name('admin.delete_member_product');

    }); 

});

/***
 * Member Dashboard Routes
 */
Route::group(['middleware'=>'auth:member','prefix'=>'member','namespace'=>'Member'],function(){
    Route::get('/dashboard', 'MemberDashboardController@index')->name('member.dashboard');
    Route::get('/profile', 'MemberDashboardController@profile')->name('member.profile');
    Route::get('/member/list', 'MemberDashboardController@memberList')->name('member.member_list');
    Route::get('/add/new', 'MemberDashboardController@addNewMemberForm')->name('member.add_new_member');

    /***
     * Sponsor ID Search
     */
    Route::get('/search/sponsorID', 'SponsorIDController@searchSponsorID')->name('member.search_sponsor_id');
}); 