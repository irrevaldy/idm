<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CorporateMerchantController extends Controller
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

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'corporate');
    $var = json_decode($form_post->getBody()->getContents());

    $form_post2 = $client->request('POST', config('constants.api_server').'merchant');
    $var2 = json_decode($form_post2->getBody()->getContents());


    //return $var;

    if($var->success == true && $var2->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;
      $this->attrib2 = $var2->result;

      return view('corporate_merchant')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib, 'attrib2' => $this->attrib2]);

      //return redirect()->action('HomeController@index');
      //return $username;
    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }
}
