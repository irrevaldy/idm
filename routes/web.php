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
Route::get('/administration/users_groups','UsersGroupsController@index');
Route::get('/administration/users_groups/get_all_dataUsers','UsersGroupsController@getUsersData');
Route::get('/administration/users_groups/get_all_dataGroups','UsersGroupsController@getGroupsData');
Route::get('/administration/users_groups/get_all_dataCorporate','CorporateMerchantController@getCorporateData');
Route::get('/administration/users_groups/get_all_dataMerchant','CorporateMerchantController@getMerchantData');


Route::get('/audit_trail','AuditTrailController@index');
Route::get('/audit_trail/get_all_data','AuditTrailController@getAllData');
Route::post('/audit_trail/result','AuditTrailController@getAuditTrail')->name('search_audit_trail');

Route::post('/update_password','GlobalController@UpdatePassword');
