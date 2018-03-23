<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class CorporateMerchantController extends Controller
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

    return view('corporate_merchant')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu]);
  }

  public function getCorporateData(Request $request)
  {

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'corporate');
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);

      $this->attrib = $var->result;

      return $this->attrib;
    }
  }

  public function getMerchantData(Request $request)
  {
      $client = new \GuzzleHttp\Client();

      $form_post = $client->request('POST', config('constants.api_server').'merchant');
      $var = json_decode($form_post->getBody()->getContents());

      if($var->success == true){
        // Session::put('id', $var->data->Id);

        $this->attrib = $var->result;

        return $this->attrib;
      }
  }

  public function addCorporateData(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");

    $corporateName = $request->input('corporateName');
    $name = $request->file('uploadedfile');

    $ext = end((explode(".", $name))); # extra () to prevent notice
    if($name == ''){
    	$name = "Default Logo";
    }
    if($name != "Default Logo")
    {
      $filename = $name->getClientOriginalName();
          	// return $filename;
      $path = Storage::putFileAs('/public/image', $name, $filename); // simpen di folder nya front end
      $storage_path = $filename;
    }
    else
    {
          	// return $filename;
      $storage_path = $name;
    }
    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'add_corporate', [
      'json' => [
        'corporateName' => $corporateName,
        'file' => $storage_path
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('corporate_merchant')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function updateCorporateData(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");

    $corporateId = $request->input('corporateId');
    $corporateName = $request->input('corporateName');
    $name = $request->file('uploadedfile');

    $ext = end((explode(".", $name))); # extra () to prevent notice
    if($name == ''){
    	$name = "Default Logo";
    }
    if($name != "Default Logo")
    {
      $filename = $name->getClientOriginalName();
          	// return $filename;
      $path = Storage::putFileAs('/public/image', $name, $filename); // simpen di folder nya front end
      $storage_path = $filename;
    }
    else
    {
      $storage_path = $name;
    }
    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'update_corporate', [
      'json' => [
        'corporateId' => $corporateId,
        'corporateName' => $corporateName,
        'file' => $storage_path
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('corporate_merchant')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function deleteCorporateData(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");

    $corporateIdDel = $request->input('corporateIdDel');

    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'delete_corporate', [
      'json' => [
        'corporateIdDel' => $corporateIdDel
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('corporate_merchant')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function addMerchantData(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");

    $corporateId = $request->input('corporateId');
    $merchName = $request->input('merchName');
    $name = $request->file('edituploadedfile');

    $ext = end((explode(".", $name))); # extra () to prevent notice
    if($name == ''){
    	$name = "Default Logo";
    }
    if($name != "Default Logo")
    {
      $filename = $name->getClientOriginalName();
          	// return $filename;
      $path = Storage::putFileAs('/public/image', $name, $filename); // simpen di folder nya front end
      $storage_path = $filename;
    }
    else
    {
          	// return $filename;
      $storage_path = $name;
    }
    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'add_merchant', [
      'json' => [
        'corporateId' => $corporateId,
        'merchName' => $merchName,
        'file' => $storage_path
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('corporate_merchant')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function updateMerchantData(Request $request)
  {
    $this->main_menu = $request->get('main_menu');
    $this->sub_menu = $request->get('sub_menu');

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Ymdhis");

    $merchId = $request->input('editMerchId');

    $corporateId = $request->input('corporateId');
    $corporateName = $request->input('corporateName');
    $name = $request->file('uploadedfile');

    $ext = end((explode(".", $name))); # extra () to prevent notice
    if($name == ''){
    	$name = "Default Logo";
    }
    if($name != "Default Logo")
    {
      $filename = $name->getClientOriginalName();
          	// return $filename;
      $path = Storage::putFileAs('/public/image', $name, $filename); // simpen di folder nya front end
      $storage_path = $filename;
    }
    else
    {
      $storage_path = $name;
    }
    $client = new \GuzzleHttp\Client();

    $form_post = $client->request('POST', config('constants.api_server').'update_corporate', [
      'json' => [
        'corporateId' => $corporateId,
        'corporateName' => $corporateName,
        'file' => $storage_path
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true){
      // Session::put('id', $var->data->Id);
      $this->attrib = $var->result;

      return view('corporate_merchant')->with(['main_menu' => $this->main_menu, 'sub_menu' => $this->sub_menu, 'attrib' => $this->attrib]);

    }
    else{
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

}
