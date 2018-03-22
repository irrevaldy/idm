<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use Session;


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
    Session::put('storage_path', $storage_path);
    $storage_path2 = Session::get('storage_path');
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
    //  return $storage_path2;
    }
  }

  public function GetUploadEdcData(Request $request)
  {
    $corporate = $request->input('corporate');
    $merchant = $request->input('merchant');
    $storage_path = Session::get('storage_path');
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

        $this->attrib3 = $var->body;

      return $this->attrib3;

    }
  }

  public function ActivateEdc(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    $merchant = $request->input('merchant');
    $storage_path = $request->input('storage_path');

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', config('constants.api_server').'edc_data/activate_edc', [
      'json' => [
        'merchant' => $merchant,
        'storage_path' => $storage_path,
        'username' => Session::get('username'),
        'user_id' => Session::get('user_id'),
        'name' => Session::get('name')
      ]
    ]);

    $var = json_decode($response->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);

        $this->attrib4 = $var->result;

        //return $this->attrib4;
      return view('edc_data')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib4' => $this->attrib4]);

    }
  }
}
