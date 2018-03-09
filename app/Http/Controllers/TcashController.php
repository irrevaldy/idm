<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    $client = new \GuzzleHttp\Client();
    $storeCode = $request->input('storeCode');
    $currLimit = $request->input('currLimit');
    $newLimit = $request->input('newLimit');

    $form_post = $client->request('POST', config('constants.api_server').'tcash/setup', [
      'json' => [
        'storeCode' => $storeCode,
        'currLimit' => $currLimit,
        'newLimit' => $newLimit,
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('tcash')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

      //return redirect()->action('HomeController@index');
      //return $username;
    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }
}
