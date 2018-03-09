<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SummaryController extends Controller
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

    return view('summary')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
  }

  public function generateSummaryTransaction(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    $client = new \GuzzleHttp\Client();
    $bank_code = $request->input('bank_code');
    $card_type = $request->input('card_type');
    $transaction_type = $request->input('transaction_type');
    $corporate = $request->input('corporate');
    $statusa = $request->input('statusa');
    $specifiedrc = $request->input('specifiedrc');
    $month = $request->input('month');

    $month = explode("/", $month);
    $month = $month[1].$month[0];

    $form_post = $client->request('POST', config('constants.api_server').'summary_transaction', [
      'json' => [
        'bank_code' => $bank_code,
        'card_type' => $card_type,
        'transaction_type' => $transaction_type,
        'corporate' => $corporate,
        'statusa' => $statusa,
        'specifiedrc' => $specifiedrc,
        'month' => $month,
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    //return $var;

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('summary')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

      //return redirect()->action('HomeController@index');
      //return $username;
    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function generateSummaryResponseCode(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    $client = new \GuzzleHttp\Client();
    $bank_code = $request->input('bank_code');
    $transaction_type = $request->input('transaction_type');
    $corporate = $request->input('corporate');
    $month = $request->input('month');

    $month = explode("/", $month);
    $month = $month[1].$month[0];

    $form_post = $client->request('POST', config('constants.api_server').'summary_response_code', [
      'json' => [
        'bank_code' => $bank_code,
        'transaction_type' => $transaction_type,
        'corporate' => $corporate,
        'month' => $month,
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    //return $var;

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib2 = $var->result;

      return view('summary')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib2' => $this->attrib2]);

      //return redirect()->action('HomeController@index');
      //return $username;
    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }
}
