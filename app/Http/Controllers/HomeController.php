<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Session;
use Khill\Lavacharts\Lavacharts;

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
      $total_edc = (int)Session::get('total_edc');
      $total_active = (int)Session::get('total_active');
      $total_not_active = (int)Session::get('total_not_active');
      $total_active_transaction = (int)Session::get('total_active_transaction');

      $lava = new Lavacharts; // See note below for Laravel

      $ratio = $lava->DataTable();

      $ratio->addStringColumn('Reasons')
              ->addNumberColumn('Percent')

              ->addRow(['EDC Active', $total_active])
              ->addRow(['EDC Not Active', $total_not_active]);

      $lava->PieChart('EDC', $ratio, [
    'pieSliceText' => 'value',
    'colors' => array('#00a65a', '#dd4b39'),
]);

      return view('index')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'total_edc' => $total_edc, 'total_active' => $total_active, 'total_not_active' => $total_not_active, 'total_active_transaction' => $total_active_transaction, 'lava' => $lava]);
    }
}
