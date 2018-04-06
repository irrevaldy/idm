<?php

/* Login*/
Route::get('/', ['uses' => 'loginController@index']);

Route::post('/login', ['as' => 'login', 'uses' => 'loginController@sendLoginData']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'loginController@logout']);

Route::get('/', function(){
	if(empty(Session::get('username')) && empty(Session::get('apitoken'))){
		return view('auth.login');
	}
	else{
		return redirect('/home');
	}

	return view('auth.login');
});

//Auth::routes();
//home
Route::get('home', 'HomeController@index')->name('home');

//search_transaction
Route::get('/search_transaction', 'SearchController@index');
Route::post('/search_transaction/main_data', ['as' => 'search_transaction_main','uses' => 'SearchController@getDataSearchTransaction']);

//report
Route::get('/report/transaction_report','TransactionReportController@index');
//Route::post('/report/transaction_report/generate_report', [ 'as' => 'transaction_report_generate','uses' => 'TransactionReportController@generateReport']);
Route::post('/report/transaction_report', 'TransactionReportController@generateReport')->name('transaction_report');
//Route::get('create-zip', 'ZipArchiveController@index')->name('create-zip');
Route::get('/report/transaction_report_financial','TransactionReportFinancialController@index');
Route::post('/report/transaction_report_financial', 'TransactionReportFinancialController@generateFinancialReport')->name('transaction_report_financial');

Route::get('/report/summary','SummaryController@index');
Route::post('/report/summary/transaction','SummaryController@generateSummaryTransaction')->name('summary_transaction');
Route::post('/report/summary/responsecode','SummaryController@generateSummaryResponseCode')->name('summary_response_code');

Route::get('/tcash','TcashController@index');
Route::post('/tcash/setlimit','TcashController@setLimit')->name('tcash_setup');

Route::get('/edc_data','EdcDataController@index');
Route::post('/edc_data/checkSN','EdcDataController@CheckSN');
Route::post('/edc_data/getSN','EdcDataController@GetSN');
Route::post('/edc_data/deleteSN','EdcDataController@DeleteSN');
Route::post('/edc_data/upload_edc','EdcDataController@UploadEdc');
Route::get('/edc_data/get_edc_data','EdcDataController@GetUploadEdcData');
Route::post('edc_data/activate_edc','EdcDataController@ActivateEdc');

Route::get('/administration/corporate_merchant','CorporateMerchantController@index');
Route::get('/administration/corporate_merchant/get_all_dataCorporate','CorporateMerchantController@getCorporateData');
Route::get('/administration/corporate_merchant/get_all_dataMerchant','CorporateMerchantController@getMerchantData');
Route::post('/administration/corporate_merchant/addCorporate','CorporateMerchantController@addCorporateData');
Route::post('/administration/corporate_merchant/updateCorporate','CorporateMerchantController@updateCorporateData');
Route::post('/administration/corporate_merchant/deleteCorporate','CorporateMerchantController@deleteCorporateData');
Route::post('/administration/corporate_merchant/addMerchant','CorporateMerchantController@addMerchantData');
Route::post('/administration/corporate_merchant/updateMerchant','CorporateMerchantController@updateMerchantData');
Route::post('/administration/corporate_merchant/deleteMerchant','CorporateMerchantController@deleteMerchantData');

Route::get('/administration/users_groups','UsersGroupsController@index');
Route::get('/administration/users_groups/get_all_dataUsers','UsersGroupsController@getUsersData');
Route::get('/administration/users_groups/get_all_dataGroups','UsersGroupsController@getGroupsData');
Route::post('/administration/users_groups/addUsers','UsersGroupsController@addUsersData');
Route::post('/administration/users_groups/updateUsers','UsersGroupsController@updateUsersData');
Route::post('/administration/users_groups/deleteUsers','UsersGroupsController@deleteUsersData');
Route::post('/administration/users_groups/addGroups','UsersGroupsController@addGroupsData');
Route::post('/administration/users_groups/updateGroups','UsersGroupsController@updateGroupsData');
Route::post('/administration/users_groups/deleteGroups','UsersGroupsController@deleteGroupsData');

Route::get('/audit_trail','AuditTrailController@index');
Route::get('/audit_trail/get_all_data','AuditTrailController@getAllData');
Route::post('/audit_trail/result','AuditTrailController@getAuditTrail')->name('search_audit_trail');

Route::post('/update_password','GlobalController@UpdatePassword');
Route::get('/host_data','GlobalController@GetHostData');
Route::get('/branch_data','GlobalController@GetBranchData');
Route::get('/bank_data','GlobalController@GetBankData');
Route::get('/card_data','GlobalController@GetCardData');
Route::get('/corporate_data','GlobalController@GetCorporateData');
Route::post('/merchant_data','GlobalController@GetMerchantData');
Route::post('/group_data','GlobalController@GetGroupData');
Route::get('/merchant_data_all','GlobalController@GetMerchantDataAll');
Route::get('/institute_data','GlobalController@GetInstituteData');
Route::post('/policy_data','GlobalController@GetPolicyData');
Route::get('/sidebar','GlobalController@GetSidebar');
