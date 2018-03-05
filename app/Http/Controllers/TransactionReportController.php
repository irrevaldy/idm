<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZIPARCHIVE;
use Illuminate\Support\Facades\DB;

class TransactionReportController extends Controller
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

    return view('transaction_report')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
  }

  public function generateReport(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    $code = $request->input('code');
    $branch = $request->input('branch_code');
    $range = $request->input('range');
    $date = $request->input('date');
    $username = $request->session()->get('username');
    $merchId = $request->session()->get('merch_id');

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

    if($range == 'w' )
    {
        $endPoint = date('Ymd', strtotime('-7 days '.$dateFormat));
    }
    else
    {
        $endPoint = $dateFormat;
    }

    $expDate = explode('/', $date);
    //$dateFormat = date('Ymd', strtotime($date));
    $dateFormat = $expDate[2].$expDate[1].$expDate[0];

    //echo $dateFormat;break;
    if($branch == '')
    {
      switch ($range)
      {
        case 'd':
          $expDate = explode('/', $date);
          //$dateFormat = date('Ymd', strtotime($date));
          $dateFile = $expDate[2].$expDate[1].$expDate[0];
          $filename = 'DetailReportByHost_'.$dateFile."_".$username;
          break;
        case 'm':
          $expDate = explode('/', $date);
          //$dateFormat = date('Ymd', strtotime($date));
          $dateFile = $expDate[2].$expDate[1];
          $filename = 'DetailReportByHost_'.$dateFile."_".$username;
          break;
        case 'w':
          $dateN = date('d/m/Y', strtotime('-7 days '.$dateFormat));
          $sDate = explode('/', $date);
          $sDate = $sDate[2].$sDate[1].$sDate[0];
          $eDate = explode('/', $dateN);
          $eDate = $eDate[2].$eDate[1].$eDate[0];
          $filename = 'DetailReportByHost_'.$eDate.'_'.$sDate."_".$username;
        break;
      default:
        # code...
        break;
      }

      $sp = "[spPortal_GenerateReportByBank_CMD] '$code', '$branch', '$dateFormat', '$range', '$endPoint', '$merchId', '$filename'";

	    //$sp = DB::statement("[spPortal_GenerateReportByBank_CMD] '$code', '$branch', '$dateFormat', '$range', '$endPoint', '$merchId', '$filename' ");

      $fullFileName = $filename.$extFile;
      $fullPath = $rootReport.$filename.$extFile;

      if(sqlsrv_query($conn, $sp))
      {
        ob_get_clean();

        if (file_exists($fullPath))
        {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename='. basename($fullPath));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($fullPath));
          readfile($fullPath);

          //return view('transaction_report');
        }
      }
    }
    else if ($branch != '')
    {
      $files = array();
      switch ($range)
      {
        case 'd':
          $expDate = explode('/', $date);
          //$dateFormat = date('Ymd', strtotime($date));
          $dateFile = $expDate[2].$expDate[1].$expDate[0];
          $filename = 'DetailReportByHost_'.$dateFile."_".$branch."_".$merchId;
          array_push($files, $filename.$extFile);
          break;
        case 'm':
          $expDate = explode('/', $date);
          //$dateFormat = date('Ymd', strtotime($date));
          $dateFile = $expDate[2].$expDate[1];
          //$filename = 'DetailReportByHost_'.$dateFile."_".$username;
          $first_date = '01-'.$expDate[1].'-'.$expDate[2];
          $first_date  = date('Ym01', strtotime($first_date));
          $last_date  = date('Ymt', strtotime($first_date));

          //for($i=$first_date; $i<=$last_date; $i++) {
          for($i=$first_date; $i<=$last_date; $i++)
          {
            $filename = 'DetailReportByHost_'.$i.'_'.$branch."_".$merchId;
            array_push($files, $filename.$extFile);
          }
          break;
        case 'w':
          $dateN = date('d/m/Y', strtotime('-6 days '.$dateFormat));
          $sDate = explode('/', $date);
          $sDate = $sDate[2].$sDate[1].$sDate[0];
          $eDate = explode('/', $dateN);
          $eDate = $eDate[2].$eDate[1].$eDate[0];
          //$filename = 'DetailReportByHost_'.$eDate.'_'.$sDate."_".$branch;

          for($i=$eDate; $i<=$sDate; $i++)
          {
              $filename = 'DetailReportByHost_'.$i.'_'.$branch."_".$merchId;
              array_push($files, $filename.$extFile);
          }
          break;
        default:
          # code...
          break;
      }

      $zipname = $username.'.zip';
      $zip = new ZipArchive;
      //$zip->open($zipname, ZipArchive::OVERWRITE );

      if (file_exists($zipname)) {
          $zip->open($zipname, ZipArchive::OVERWRITE );
      } else {
          $zip->open($zipname, ZIPARCHIVE::CREATE );
      }

      foreach ($files as $file)
      {
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
  return view('transaction_report')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
  }
}
