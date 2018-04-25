<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class SearchController extends Controller
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
    $form_post = $client->request('GET', config('constants.api_server').'search_transaction/line_data');
  	$var = json_decode($form_post->getBody()->getContents());
    //return $var;

    $lava = new Lavacharts; // See note below for Laravel

    $transaction = $lava->DataTable();

    $transaction->addDateColumn('Transaction Date')
                 ->addNumberColumn('Total Transaction')
                 ->addRows($var);

    $lava->LineChart('Transaction', $transaction, [
        'title' => 'Total Transaction Per Date'
    ]);

    return view('search_transaction')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'lava' => $lava]);
  }

  public function getDataSearchTransaction(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $store_code = $request->input('store_code');
    $branch_code = $request->input('branch_code');
    $host = $request->input('host');
    $transaction_type = $request->input('transaction_type');
    $prepaid_card_number = $request->input('prepaid_card_number');
    $approval_code = $request->input('approval_code');
    $mid = $request->input('mid');
    $tid = $request->input('tid');
    $transaction_date = $request->input('transaction_date');

  	$form_post = $client->request('POST', config('constants.api_server').'search_transaction', [
  		'json' => [
  			'store_code' => $store_code,
  			'branch_code' => $branch_code,
        'host' => $host,
        'transaction_type' => $transaction_type,
        'prepaid_card_number' => $prepaid_card_number,
        'approval_code' => $approval_code,
        'mid' => $mid,
        'tid' => $tid,
        'transaction_date' => $transaction_date
  		]
  	]);
  	$var = json_decode($form_post->getBody()->getContents());

  	//return $var;

    if($var->success == true)
    {
  		// Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

  		//return view('search_transaction')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);
      //return redirect()->action('SearchController@index', ['attrib' => $this->attrib]);
      //return redirect()->action('HomeController@index');
      return $this->attrib;
  	}
  	else{
  		return Redirect::back()->withInput()->withErrors($var->message);
  	}
  }

  public function GetSeriesSeconds(Request $request)
  {
    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('GET', config('constants.api_server').'search_transaction/series_seconds');

  	$var = json_decode($form_post->getBody()->getContents());

    return $var;
  }
}
