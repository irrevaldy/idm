<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
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

      $sidebar = 'sidebar-collapse';
			// Session::put('id', $var->data->Id);
      Session::put('user_id', $var->data->user_id);
			Session::put('username', $var->data->username);
      Session::put('name', $var->data->name);
      Session::put('FID', $var->data->FID);
      Session::put('group_id', $var->data->group_id);
      Session::put('groupName', $var->data->groupName);
      Session::put('merch_id', $var->data->merch_id);
      Session::put('FCODE', $var->data->FCODE);
      Session::put('FNAME', $var->data->FNAME);
			Session::put('apitoken', $var->data->token);
      Session::put('branch_code', $var->data->branch_code);
      Session::put('logo', $var->data->logo);

      //Session::put('merchant', $var->data->merchant);
     //Session::put('branch', $var->data->branch);

      Session::put('total_edc', $var->data->total_edc);
      Session::put('total_active', $var->data->total_active);
      Session::put('total_not_active', $var->data->total_not_active);
      Session::put('total_active_transaction', $var->data->total_active_transaction);
      Session::put('sidebar', $sidebar);


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
				'username' => Session::get('username'),
        'user_id' => Session::get('user_id'),
        'name' => Session::get('name')
			]
		]);

		if($form_post){
			Session::flush();
			return redirect('/');
		}
	}
}
