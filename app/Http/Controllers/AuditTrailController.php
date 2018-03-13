<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditTrailController extends Controller
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



      return view('audit_trail')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);

      //return redirect()->action('HomeController@index');
      //return $username;

  }

  public function getAllData(Request $request)
  {
    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");
    $past = date("Ym", strtotime("-3 month"));
    $past .= "01000000";

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'audit_trail', [
			'json' => [
				'now' => $now,
				'past' => $past
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

  public function getAuditTrail(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    $client = new \GuzzleHttp\Client();
    $datePost = $request->input('date');

    $date = explode(" - ", $datePost);
    $date_now = $date[1];
    $now = explode("/", $date_now);
    $now_txt = $now[2].$now[1].$now[0];
    $now_txt .= "235959";

    $date_past = $date[0];
    $past = explode("/", $date_past);
    $past_txt = $past[2].$past[1].$past[0];
    $past_txt .= "000000";

    $form_post = $client->request('POST', config('constants.api_server').'audit_trail', [
			'json' => [
				'now' => $now_txt,
				'past' => $past_txt
			]
		]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('audit_trail')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

      //return redirect()->action('HomeController@index');
      //return $username;
    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }
}
