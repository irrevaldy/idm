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

Route::get('/administration/corporate_merchant','CorporateMerchantController@index');
Route::get('/administration/users_groups','UsersGroupsController@index');

Route::get('/audit_trail','AuditTrailController@index');
Route::post('/audit_trail/result','AuditTrailController@getAuditTrail')->name('search_audit_trail');
