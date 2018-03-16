<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;


class EdcDataController extends Controller
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

    return view('edc_data')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
  }

  public function CheckSN(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $username = $request->input('username');

    $form_post = $client->request('POST', config('constants.api_server').'edc_data/checkSN', [
      'json' => [
        'username' => $username
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);

      return $var->status;

      //return redirect()->action('HomeController@index');
      //return $username;
    }
  }

  public function GetSN(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $username = $request->input('username');

    $form_post = $client->request('POST', config('constants.api_server').'edc_data/getSN', [
      'json' => [
        'username' => $username
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);

      $this->attrib = $var->result;

      return $this->attrib;

      //return redirect()->action('HomeController@index');
      //return $username;
    }
  }

  public function DeleteSN(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $username = $request->input('username');

    $form_post = $client->request('POST', config('constants.api_server').'edc_data/deleteSN', [
      'json' => [
        'username' => $username
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);

      return $var->status;

      //return redirect()->action('HomeController@index');
      //return $username;
    }
  }

  public function UploadEdc(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    $corporate = $request->input('corporate');
    $merchant = $request->input('merchant');
    $file = $request->file('uploadedfile');

    $filename = $file->getClientOriginalName();
        	// return $filename;
    $path = Storage::putFileAs('/public/upload', $file, $filename); // simpen di folder nya front end
    $storage_path = storage_path('app/public/upload/'.$filename);
    //return $storage_path;

    	$client = new \GuzzleHttp\Client();
		$response = $client->request('POST', config('constants.api_server').'edc_data/upload_edc', [
      'json' => [
        'corporate' => $corporate,
        'merchant' => $merchant,
        'storage_path' => $storage_path
      ]
    ]);

		$var = json_decode($response->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);

      $this->attrib = $var->result;
      $this->attrib2 = $var->header2;

      return view('edc_data')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib, 'attrib2' => $this->attrib2]);
      //return $this->attrib;
      //return redirect()->action('HomeController@index');
      //return $username;
    }
  }
}
