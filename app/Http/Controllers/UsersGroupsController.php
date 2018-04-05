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
    $group_id = Session::get('group_id');

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'groups', [
			'json' => [
        'FCODE' => $FCODE,
				'group_id' => $group_id
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

  public function addUsersData(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");

    $name = $request->input('name');
    $group = $request->input('group');
    $branch = $request->input('branch');
    $note = $request->input('note');
    $username = $request->input('username');
    $username = strtolower($username);
    $password = $request->input('password');
    $password = hash('sha256', $password);
    $priv = $request->input('privileges');

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'add_users', [
      'json' => [
        'name' => $name,
        'group' => $group,
        'branch' => $branch,
        'note' => $note,
        'username' => $username,
        'password' => $password,
        'priv' => $priv
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('users_groups')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function updateUsersData(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");

    $user_id = $request->input('edit_user_id');
    $name = $request->input('edit_name');
    $group = $request->input('edit_group');
    $branch = $request->input('edit_branch');
    $note = $request->input('edit_note');
    $username = $request->input('edit_username');
    $username = strtolower($username);
    $password = $request->input('edit_password');
    $password = hash('sha256', $password);
    $status = $request->input('status');

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'update_users', [
      'json' => [
        'user_id' => $user_id,
        'name' => $name,
        'group' => $group,
        'branch' => $branch,
        'note' => $note,
        'username' => $username,
        'password' => $password,
        'status' => $status,
        'session_username' => Session::get('username'),
        'session_user_id' => Session::get('user_id'),
        'session_name' => Session::get('name')
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('users_groups')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function deleteUsersData(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");

    $delete_user_id = $request->input('delete_user_id');
    $delete_name = $request->input('delete_name');

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'delete_users', [
      'json' => [
        'delete_user_id' => $delete_user_id,
        'delete_name' => $delete_name,
        'session_username' => Session::get('username'),
        'session_user_id' => Session::get('user_id'),
        'session_name' => Session::get('name')
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('users_groups')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function addGroupsData(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");

    $name = $request->input('name');
    $note = $request->input('note');
    $institute = $request->input('institute');
    $merchant = $request->input('merchant');
    $priv = $request->input('privileges');

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'add_groups', [
      'json' => [
        'name' => $name,
        'note' => $note,
        'institute' => $institute,
        'merchant' => $merchant,
        'priv' => $priv,
        'session_username' => Session::get('username'),
        'session_user_id' => Session::get('user_id'),
        'session_name' => Session::get('name')
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('users_groups')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function updateGroupsData(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");

    $group_id = $request->input('edit_group_id2');
    $name = $request->input('edit_group2');
    $institute = $request->input('edit_host2');
    $merchant = $request->input('edit_merchant2');
    $note = $request->input('edit_merchant2');
    $status = $request->input('group_status');
    $priv = $request->input('edit_privileges2');

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'update_groups', [
      'json' => [
        'group_id' => $group_id,
        'name' => $name,
        'institute' => $institute,
        'merchant' => $merchant,
        'note' => $note,
        'status' => $status,
        'priv' => $priv,
        'session_username' => Session::get('username'),
        'session_user_id' => Session::get('user_id'),
        'session_name' => Session::get('name')
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('users_groups')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function deleteGroupsData(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");

    $delete_group_id = $request->input('delete_group_id');
    $delete_groupName = $request->input('delete_groupName2');
    $delete_group_host = $request->input('delete_group_host');

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'delete_groups', [
      'json' => [
        'delete_group_id' => $delete_group_id,
        'delete_groupName' => $delete_groupName,
        'delete_group_host' => $delete_group_host,
        'session_username' => Session::get('username'),
        'session_user_id' => Session::get('user_id'),
        'session_name' => Session::get('name')
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('users_groups')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }
}
