<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Session;

class HomeController extends Controller
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

      // $this->merchant = Session::get('merchant');
      // $this->branch = Session::get('branch');
      $this->total_edc = Session::get('total_edc');
      $this->total_active = Session::get('total_active');
      $this->total_not_active = Session::get('total_not_active');
      $this->total_active_transaction = Session::get('total_active_transaction');

      return view('index')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'total_edc' => $this->total_edc, 'total_active' => $this->total_active, 'total_not_active' => $this->total_not_active, 'total_active_transaction' =>$this->total_active_transaction]);
    }
}
