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
/*
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

//Route::post('/login', ['as' => 'login', 'uses' => 'loginController@sendLoginData']);
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//search_transaction
Route::get('/search_transaction', 'SearchController@index');
Route::post('/search_transaction/main_data', ['uses' => 'SearchController@getDataSearchTransaction']);
