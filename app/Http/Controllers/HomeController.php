<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Session;
/*
class HomeController extends Controller
{
    private $main_menu;
    private $sub_menu;

    public function __construct()
    {
      //$this->Middleware('auth');
		  $this->Middleware(array('CustomAuthChecker','DynamicMenu'));
    }

    // public function index(Request $request)
    // {
    //
		//      $this->main_menu = $request->get('main_menu');
		//      $this->sub_menu = $request->get('sub_menu');
    //
    //     return view('index')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
    //     //return view('home');
    // }

    public function index(Request $request)
    {

  		// $this->main_menu = $request->get('main_menu');
  		//  $this->sub_menu = $request->get('sub_menu');
      //
      // return view('index')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
      //return view('home');

      $client = new \GuzzleHttp\Client();
      $get_main_menu = $client->request('GET', config('constants.api_server').'menu/main/'.Session::get('group_id').'/api_token='.Session::get('token'));
      $main_menu = json_decode($get_main_menu->getBody()->getContents());
      $main_menu = $main_menu->data;

      $get_sub_menu = $client->request('GET', config('constants.api_server').'menu/regular/'.Session::get('group_id').'/api_token='.Session::get('token'));
      $sub_menu = json_decode($get_sub_menu->getBody()->getContents());
      $sub_menu = $sub_menu->data;

      $data['main_menu'] = $main_menu;
      $data['sub_menu'] = $sub_menu;

      return view('index')->with('data', $data);


    }
}
*/
class HomeController extends Controller
{
    private $main_menu;
    private $sub_menu;

    public function __construct()
    {
      //$this->Middleware('auth');
		  $this->Middleware(array('CustomAuthChecker','DynamicMenu'));
    }

    // public function index(Request $request)
    // {
    //
		//      $this->main_menu = $request->get('main_menu');
		//      $this->sub_menu = $request->get('sub_menu');
    //
    //     return view('index')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
    //     //return view('home');
    // }

    public function index(Request $request)
    {

  		$this->main_menu = $request->get('main_menu');
  		 $this->sub_menu = $request->get('sub_menu');
       $total_edc = $request->session()->get('total_edc');
        $total_active = $request->session()->get('total_active');
       $total_non_active = $request->session()->get('total_non_active');
       $total_active_transaction = $request->session()->get('total_active_transaction');
     //return view('index')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu/*, 'total_edc' => $total_edc, 'total_active' => $total_active, 'total_non_active' => $total_non_active, 'total_active_transaction' => $total_active_transaction*/]);

      return view('index')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'total_edc' => $total_edc, 'total_active' => $total_active, 'total_non_active' => $total_non_active, 'total_active_transaction' => $total_active_transaction]);
    //  return view('home');
    }

}
