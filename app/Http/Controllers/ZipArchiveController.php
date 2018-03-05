<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;

class ZipArchiveController extends Controller
{
  public function index(Request $request)
  {


    $rootReport = "C://generate/";
    $extFile = ".csv";
    $file = "zzz.csv";
    //$files = array('20170301.csv', '20170302.csv', '20170303.csv', '20170304.csv', '20170305.csv');

    $zipname = 'administrator.zip';
    $zip = new ZipArchive;
    //$zip->open($zipname, ZipArchive::OVERWRITE );

    if (file_exists($zipname)) {
        $zip->open($zipname, ZipArchive::OVERWRITE );
    } else {
        $zip->open($zipname, ZIPARCHIVE::CREATE );
    }

    $zip->addFile($rootReport.$file, $file);

    $zip->close();

    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename='.$zipname);
    header('Content-Length: ' . filesize($zipname));
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile($zipname);

      return view('create-zip');
  }
}
