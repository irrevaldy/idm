<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class TcashController extends Controller
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

    return view('tcash')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
  }

  public function setLimit(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $storeCode = $request->input('code');
    $newLimit = $request->input('limit');

    $form_post = $client->request('POST', config('constants.api_server').'tcash/setup', [
      'json' => [
        'storeCode' => $storeCode,
        'newLimit' => $newLimit
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
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function checkLimit(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    $client = new \GuzzleHttp\Client();
    $storeCode = $request->input('code');

    $form_post = $client->request('POST', config('constants.api_server').'tcash/checkLimit', [
      'json' => [
        'storeCode' => $storeCode,
        'branchCode' => Session::get('branch_code'),
        'merch_id' => Session::get('merch_id'),
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());
    //$var = json_decode($form_post->getBody()->getContents(), true);

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return response()->json($this->attrib);

      //return redirect()->action('HomeController@index');
      //return $username;
    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }

    //return $form_post;
  }
}
