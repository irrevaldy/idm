<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EdcDataController extends Controller
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

    return view('edc_data')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
  }

  public function CheckSN(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $username = $request->input('username');

    $form_post = $client->request('POST', config('constants.api_server').'edc_data/checkSN', [
      'json' => [
        'username' => $username
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);

      return $var->status;

      //return redirect()->action('HomeController@index');
      //return $username;
    }
  }

  public function GetSN(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $username = $request->input('username');

    $form_post = $client->request('POST', config('constants.api_server').'edc_data/getSN', [
      'json' => [
        'username' => $username
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
