<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
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

   return view('chart')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
  }

  public function BarChart(Request $request)
  {
   $client = new \GuzzleHttp\Client();
   $form_post = $client->request('GET', config('constants.api_server').'monitoring_bar_chart');

   $var = json_decode($form_post->getBody()->getContents());

   return $var;
  }
}
