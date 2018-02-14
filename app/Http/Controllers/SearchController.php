<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('search_transaction')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
      }

      public function getDataSearchTransaction(Request $request)
      {
        $client = new \GuzzleHttp\Client();
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
            'transaction_date' => $transaction_date,
    			]
    		]);
    		$var = json_decode($form_post->getBody(), true);

    		return $var;
      }
}
