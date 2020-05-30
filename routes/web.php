<?php

require __DIR__.'/frontend.php';

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
    Route::get('/search/memberID', 'EpinAllotController@searchMemberID')->name('member.search_member_id');
    Route::post('/add/new/allot/epin', 'EpinAllotController@memAllotEpin')->name('admin.mem_allot_epin');
    
    /***
     * Member Macthing Income Control
     */
    Route::get('/matching/income', 'MatchingIncomeController@memMatchingIncomeForm')->name('admin.mem_matching_income');
    Route::post('/add/matching/income', 'MatchingIncomeController@memAddMatchingIncome')->name('admin.mem_add_matching_income');
    
    /***
     * Pair Cut OFF Control
     */
    Route::get('/pair/timing', 'PairCutoffController@memPairTiming')->name('admin.mem_pair_timing');
    Route::post('/add/pair/timing', 'PairCutoffController@memAddPairTiming')->name('admin.mem_add_pair_timing');

    Route::get('/pair/cuttoff', 'PairCutoffController@memPairCutoff')->name('admin.mem_pair_cutoff');
    Route::post('/add/pair/cutoff', 'PairCutoffController@memAddPairCutoff')->name('admin.mem_add_pair_cut_off');
    Route::get('/ajax/pair/cutoff', 'PairCutoffController@memAjaxPairCutoff')->name('admin.ajax.cutOff_list');
    Route::get('/edit/pair/cutoff/{id}', 'PairCutoffController@editPairCutoff')->name('admin.edit.mem_pair_cutoff');
    Route::post('/update/pair/cutoff', 'PairCutoffController@memUpdatePairCutoff')->name('admin.mem_update_pair_cut_off');
    Route::get('/delete/pair/cutoff/{id}', 'PairCutoffController@memDeletePairCutoff')->name('admin.delete.mem_pair_cutoff');
    
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

    /**
     * Member List
     */
    Route::get('/list/members', 'MemberListController@memberList')->name('admin.mem_member_list');
    Route::get('/list/all/members', 'MemberListController@ajaxGetMemberList')->name('admin.ajax.get_member_list');
    Route::get('/status/member/{id}/{status}', 'MemberListController@memberStatus')->name('admin.member_status');
    Route::get('/view/member/{id}', 'MemberListController@memberView')->name('admin.member_view');
    Route::get('/edit/member/{id}', 'MemberListController@memberEdit')->name('admin.member_edit');
    Route::post('/edit/member/', 'MemberListController@memberUpdate')->name('admin.update_member');
    Route::get('/downline/member/{id}', 'MemberListController@memberDownline')->name('admin.member_downline');
    Route::get('/verify/member/{id}/{status}', 'MemberListController@memberVerify')->name('admin.member_verify');
    Route::get('/downline/member/list/{id}', 'MemberListController@memberDownlineList')->name('admin.ajax.downline_list');
    Route::get('/commission/members', 'MemberListController@memberCommissionHistory')->name('admin.mem_commission_history');
    Route::get('/commission/history', 'MemberListController@memberCommissionHistoryList')->name('admin.ajax.commission_list');
    Route::get('/wallet/', 'MemberListController@memberWallet')->name('admin.mem_wallet');
    Route::get('/wallet/list', 'MemberListController@memberWalletList')->name('admin.ajax.wallet_list');
    Route::get('/wallet/history/{id}', 'MemberListController@memberWalletHistory')->name('admin.wallet_history');
    Route::get('/wallet/ajax/history/{id}', 'MemberListController@memberAjaxWalletHistory')->name('admin.ajax.wallet_history');
    Route::get('/member/tree/{rank?}/{user_id?}', 'MemberListController@memberTree')->name('admin.member.tree');


        
    /**
     * Shopping Product List Control
     */

    //Shopping Product
    Route::get('/shopping/product', 'ShoppingProductController@shoppingProduct')->name('admin.shopping_product');
    Route::get('/shopping/product/add', 'ShoppingProductController@addShoppingProduct')->name('admin.add_shopping_product');
    Route::post('/shopping/product/store', 'ShoppingProductController@storeShoppingProduct')->name('admin.store_shopping_product');
    Route::get('/shopping/product/list', 'ShoppingProductController@ShoppingProductList')->name('admin.shopping_product_list');
    Route::get('/shopping/product/status/{pId}/{status}', 'ShoppingProductController@ShoppingProductStatus')->name('admin.shopping_product_status');
    Route::get('/shopping/product/edit/{id}', 'ShoppingProductController@ShoppingProductEdit')->name('admin.shopping_product_edit');
    Route::post('/shopping/product/update', 'ShoppingProductController@ShoppingProductUpdate')->name('admin.update_shopping_product');

    //Shopping Category
    Route::get('/shopping/category', 'ShoppingProductController@shoppingCategory')->name('admin.shopping_category');
    Route::get('/shopping/category/add', 'ShoppingProductController@addShoppingCategory')->name('admin.add_shopping_category');
    Route::post('/shopping/category/store', 'ShoppingProductController@storeShoppingCategory')->name('admin.store_shopping_category');
    Route::get('/shopping/category/list', 'ShoppingProductController@ShoppingCategoryList')->name('admin.shoppingCategoryList');
    Route::get('/shopping/category/status/{pId}/{status}', 'ShoppingProductController@ShoppingCategoryStatus')->name('admin.shopping_category_status');
    Route::get('/shopping/category/edit/{id}', 'ShoppingProductController@ShoppingCategoryEdit')->name('admin.shopping_category_edit');
    Route::post('/shopping/category/update/{id}', 'ShoppingProductController@ShoppingCategoryUpdate')->name('admin.update_shopping_category');
    
    /**
     * Important Notice
     */
    Route::get('/important/notice/page', 'AdminDashboardController@importantNoticePage')->name('admin.important_notice');
    Route::post('/important/notice', 'AdminDashboardController@importantNotice')->name('admin.store_important_notice');
    Route::get('/my/notice/list', 'AdminDashboardController@getNoticeList')->name('admin.ajax.notice_list');
    Route::get('/view/notice/{id}', 'AdminDashboardController@viewNotice')->name('admin.notice_view');
    Route::get('/status/notice/{id}/{status}', 'AdminDashboardController@noticeStatus')->name('admin.notice_status');

    // Complaint/Feedback
    Route::get('/all/feedback', 'AdminDashboardController@feedBack')->name('admin.feedback');
    
});

/***
 * Member Dashboard Routes
 */
Route::group(['middleware'=>'auth:member','prefix'=>'member','namespace'=>'Member'],function(){
    Route::get('/dashboard', 'MemberDashboardController@index')->name('member.dashboard');
    Route::get('/profile', 'MemberDashboardController@profile')->name('member.profile');
    Route::get('/member/list', 'MemberDashboardController@memberList')->name('member.member_list');
    Route::get('/add/new', 'MemberDashboardController@addNewMemberForm')->name('member.add_new_member_form');
    Route::get('/add/epin/{epin_page_token}', 'MemberDashboardController@addEpinForm')->name('member.add_epin_form');
    Route::get('/add/product/{product_page_token}', 'MemberDashboardController@productPage')->name('member.product_page');
    Route::get('/add/kyc/{kyc_page_token}/{user_id}', 'MemberDashboardController@kycPage')->name('member.kyc_page');
    Route::get('/add/finish/{finish_page_token}', 'MemberDashboardController@finishPage')->name('member.finish_page');
    Route::get('/my/epin/', 'MemberEpinController@memberEpinListForm')->name('member.mem_epin_list_form');
    Route::get('/my/epin/list', 'MemberEpinController@memberGetEpinList')->name('member.ajax.my_epin_list');
    Route::get('/my/downline/', 'MemberDashboardController@memberDownlineListForm')->name('member.mem_downline_list_form');
    Route::get('/my/downline/list', 'MemberDashboardController@memberGetDownlineList')->name('member.ajax.my_downline_list');
    Route::get('/my/commission', 'MemberDashboardController@memberCommissionListForm')->name('member.mem_commission_list_form');
    Route::get('/my/order', 'MemberDashboardController@memberOrderListForm')->name('member.mem_order_list_form');
    Route::get('/my/tree/{rank?}/{user_id?}', 'MemberDashboardController@memberTree')->name('member.tree');
    Route::get('/my/tree/list', 'MemberDashboardController@memberTreeData')->name('member.tree_data');
    
    Route::get('/my/wallet/', 'MemberDashboardController@memberWalletListForm')->name('member.mem_wallet_list_form');
    Route::get('/ajax/get/wallet/history','MemberDashboardController@ajaxGetWalletHistory')->name('member.ajax.my_wallet_history');
    /***
     * Sponsor ID Search
     */
    Route::get('/search/sponsorID', 'SponsorIDController@searchSponsorID')->name('member.search_sponsor_id');
    
    /***
     * Epin Validate
     */
    
    Route::get('/validate/EPIN', 'MemberRegistrationController@validateEPIN')->name('member.validate_epin');
    
    /***
     * Member Registration Controller
     */
    Route::post('/add', 'MemberRegistrationController@addNewMember')->name('member.add_new_member');
    Route::post('/epin/data', 'MemberRegistrationController@epinSubmit')->name('member.epin_submit');
    Route::post('/product/data', 'MemberRegistrationController@productPurchase')->name('member.product_purchase');
    Route::post('/kyc/data', 'MemberRegistrationController@kycSubmit')->name('member.kyc_submit');
    
    /**
     * Commission History Generate
     */
    
    Route::get('/ajax/get/commission','CommissionHistoryController@ajaxGetCommissionList')->name('member.ajax.my_commission_list');
    Route::get('/ajax/get/order','OrderHistoryController@ajaxGetOrderList')->name('member.ajax.my_order_list');

    // Member Password Change
    Route::get('/change/password', 'MemberDashboardController@changePasswordPage')->name('member.change_password');
    Route::post('/changePassword','MemberDashboardController@changePassword')->name('member.changePassword');
    
    Route::get('/account/update/page', 'MemberDashboardController@accountUpdatePage')->name('member.account_update');
    Route::post('/update/member','MemberDashboardController@updateMember')->name('member.update_member');
    
    // Member Notice
    Route::get('/member/notice/{id}', 'MemberDashboardController@getNotice')->name('member.notice');

    // Feedback or Compalint
    Route::get('/member/feedback', 'MemberDashboardController@feedBack')->name('member.feedback');
    Route::post('/store/complaint','MemberDashboardController@storeComplaint')->name('member.store_complaint');
    Route::post('ck-editor-image-upload','MemberDashboardController@ckEditorImageUpload')->name('member.ck_editor_image_upload');
    Route::get('/my/feedback/list', 'MemberDashboardController@getFeedbackList')->name('admin.ajax.feedback_list');
}); 
