<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Session;

class UsersGroupsController extends Controller
{
  private $main_menu;
  private $sub_menu;

  public function __construct()
  {
    //$this->Middleware('auth');
    $this->Middleware(array('CustomAuthChecker','DynamicMenu'));
  }

  public function index(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    return view('users_groups')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);

  }

  public function getUsersData(Request $request)
  {
    $FCODE = Session::get('FCODE');
    $user_id = Session::get('user_id');

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'users', [
      'json' => [
        'FCODE' => $FCODE,
        'user_id' => $user_id
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);

      $this->attrib = $var->result;

      return $this->attrib;

      //return redirect()->action('HomeController@index');
      //return $username;
    }
  }

  public function getGroupsData(Request $request)
  {
    $FCODE = Session::get('FCODE');
    $user_id = Session::get('user_id');

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'groups', [
			'json' => [
        'FCODE' => $FCODE,
				'user_id' => $user_id
			]
		]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);

      $this->attrib = $var->result;

      return $this->attrib;

      //return redirect()->action('HomeController@index');
      //return $username;
    }
  }
}
