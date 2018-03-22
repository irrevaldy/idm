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

    return view('corporate_merchant')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
  }

  public function getCorporateData(Request $request)
  {

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'corporate');
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);

      $this->attrib = $var->result;

      return $this->attrib;
    }
  }

  public function getMerchantData(Request $request)
  {
      $client = new \GuzzleHttp\Client();

      $form_post = $client->request('POST', config('constants.api_server').'merchant');
      $var = json_decode($form_post->getBody()->getContents());

      if($var->success == true){
        // Session::put('id', $var->data->Id);

        $this->attrib = $var->result;

        return $this->attrib;
      }
  }
}
