<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Session;

class loginController extends Controller
{

    public function __construct(){
        //$this->middleware('auth');
    }

    public function index(){

        return view('auth.login');
    }

	  public function sendLoginData(Request $request){

    $client = new \GuzzleHttp\Client();
		$username = $request->input('username');
		$password = hash('sha256', $request->input('password'));
		// return $password;

		$form_post = $client->request('POST', config('constants.api_server').'login', [
			'json' => [
				'username' => $username,
				'password' => $password
			]
		]);

		$var = json_decode($form_post->getBody()->getContents());
    //$a['a'] = $var;
    //return $a;

		if($var->success == TRUE){
			// Session::put('id', $var->data->Id);
			Session::put('username', $var->data->username);
			Session::put('group_id', $var->data->group_id);
			Session::put('apitoken', $var->data->token);
      // Session::put('merchant', $var->data->merchant);
      // Session::put('branch', $var->data->branch);

      Session::put('total_edc', $var->data->total_edc);
      Session::put('total_active', $var->data->total_active);
      Session::put('total_not_active', $var->data->total_not_active);
      Session::put('total_active_transaction', $var->data->total_active_transaction);

			return redirect('/home');

      //return redirect()->action('HomeController@index');
      //return $username;
		}
		else{
			return Redirect::back()->withInput()->withErrors($var->message);
		}
	}

	public function logout(){
		$client = new \GuzzleHttp\Client();
		$form_post = $client->request('POST', config('constants.api_server').'logout/'.session()->get('username'), [
			'json' => [
				'username' => Session::get('username')
			]
		]);

		if($form_post){
			Session::flush();
			return redirect('/');
		}
	}
}
