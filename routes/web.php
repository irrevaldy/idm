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
