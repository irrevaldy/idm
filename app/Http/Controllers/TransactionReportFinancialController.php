<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZIPARCHIVE;
use Illuminate\Support\Facades\DB;

class TransactionReportFinancialController extends Controller
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

    return view('transaction_report_financial')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
  }

  public function generateFinancialReport(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    $branch_code = $request->input('branch_code');
    $range = $request->input('range');
    $date = $request->input('date');
    $username = $request->session()->get('username');
    $merchant = $request->session()->get('merch_id');

    $now = date("YmdHis");

    $rootReport = "C://generate/";
    $extFile = ".csv";

    $serverName = "192.168.202.102"; //serverName\instanceName
    $connectionInfo = array( "Database"=>"DbWDGatewayIDM", "UID"=>"sa", "PWD"=>"pvs1909~");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    //$file = "zzz.csv";
    //$files = array('20170301.csv', '20170302.csv', '20170303.csv', '20170304.csv', '20170305.csv');

    if(strlen($date) == 7)
    {
        $date = '01/'.$date;
    }
    $expDate = explode('/', $date);
    //$dateFormat = date('Ymd', strtotime($date));
    $dateFormat = $expDate[2].$expDate[1].$expDate[0];

    error_reporting(E_ALL);

    //echo $dateFormat;break;
    if($branch_code == '')
    {
      $zipname = $username.'.zip';
      $zip = new ZipArchive;
      //$zip->open($zipname, ZipArchive::OVERWRITE );


      if (file_exists($zipname)) {
          $zip->open($zipname, ZipArchive::OVERWRITE );
      } else {
          $zip->open($zipname, ZIPARCHIVE::CREATE );
      }

      foreach ($files as $file) {
        $zip->addFile($rootReport.$file, $file);

      }

      $zip->close();

      header('Content-Type: application/zip');
      header('Content-disposition: attachment; filename='.$zipname);
      header('Content-Length: ' . filesize($zipname));
      header("Pragma: no-cache");
      header("Expires: 0");
      readfile($zipname);

    }
    else if ($branch_code != '')
    {
      $files = array();

      switch ($range) {
          case 'd':

              $info = "(1 day report, ".$date.")";

              $start = $dateFormat;
              $end = $start;

              $expDate = explode('/', $date);
                  //$dateFormat = date('Ymd', strtotime($date));
              $dateFile = $expDate[2].$expDate[1].$expDate[0];
              $filename = 'ReconsiliationReport_'.$dateFile."_".$branch_code."_".$merchant;
              //$filename = 'ReconsiliationReport_'.$dateFile."_".$username;

              array_push($files, $filename.$extFile);

              break;

           case 'm':

              $info = "(1 month report, ".substr($date, 3).")";

              $start = date('Ym', strtotime($dateFormat));
              $end = $start;

              $expDate = explode('/', $date);
                  //$dateFormat = date('Ymd', strtotime($date));
              $dateFile = $expDate[2].$expDate[1];
              $filename = 'ReconsiliationReport_'.$dateFile."_".$username;

              $first_date = '01-'.$expDate[1].'-'.$expDate[2];
              $first_date = date('Ym01', strtotime($first_date));
              $last_date  = date('Ymt', strtotime($first_date));

              //for($i=$first_date; $i<=20170621; $i++) {
              for($i=$first_date; $i<=$last_date; $i++) {

                  $filename = 'ReconsiliationReport_'.$i.'_'.$branch_code."_".$merchant;
                  //$filename = 'ReconsiliationReport_'.$i.'_'.$username;
                  array_push($files, $filename.$extFile);

              }

              break;

          case 'w':
              $dateN = date('d/m/Y', strtotime('-6 days '.$dateFormat));

              $sDate = explode('/', $date);
              $sDate = $sDate[2].$sDate[1].$sDate[0];

              $eDate = explode('/', $dateN);
              $eDate = $eDate[2].$eDate[1].$eDate[0];
              $filename = 'DetailReportByHost_'.$eDate.'_'.$sDate."_".$branch_code;

              for($i=$eDate; $i<=$sDate; $i++) {

                  $filename = 'ReconsiliationReport_'.$i.'_'.$branch_code."_".$merchant;
                  //$filename = 'ReconsiliationReport_'.$i.'_'.$username;
                  array_push($files, $filename.$extFile);

              }

              break;

          default:
              # code...
              break;
      }

      //$files = array('20170301.csv', '20170302.csv', '20170303.csv', '20170304.csv', '20170305.csv');

      $zipname = $username.'.zip';
      $zip = new ZipArchive;
      //$zip->open($zipname, ZipArchive::OVERWRITE );


      if (file_exists($zipname)) {
          $zip->open($zipname, ZipArchive::OVERWRITE );
      } else {
          $zip->open($zipname, ZIPARCHIVE::CREATE );
      }

      foreach ($files as $file) {
        $zip->addFile($rootReport.$file, $file);

      }

      $zip->close();

      header('Content-Type: application/zip');
      header('Content-disposition: attachment; filename='.$zipname);
      header('Content-Length: ' . filesize($zipname));
      header("Pragma: no-cache");
      header("Expires: 0");
      readfile($zipname);

      //return view('report/transaction_report');
    }
    //sqlsrv_close($conn);
  return view('transaction_report')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
  }
}
