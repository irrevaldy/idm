<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class GlobalController extends Controller
{
  public function UpdatePassword(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $user_id = $request->input('user_id');
    $name = $request->input('name');
    $username = $request->input('username');
    $oldPassword = $request->input('oldPassword');
    $newPassword = $request->input('newPassword');

    $form_post = $client->request('POST', config('constants.api_server').'update_password', [
      'json' => [
        'user_id' => $user_id,
        'name' => $name,
        'username' => $username,
        'oldPassword' => $oldPassword,
        'newPassword' => $newPassword,
      ]
    ]);
    $var = json_decode($form_post->getBody()->getContents());

    return $var->status;
  }

  public function GetHostData(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $form_post = $client->request('GET', config('constants.api_server').'host_data', [
      'json' => [
        'merch_id' => Session::get('merch_id')
      ]
    ]);

		$var = json_decode($form_post->getBody()->getContents());

    if($var->success == true)
    {
      $this->attrib = $var->result;

      return $this->attrib;
    }
    else
    {
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }

  public function GetBranchData(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $form_post = $client->request('GET', config('constants.api_server').'branch_data', [
      'json' => [
        'merch_id' => Session::get('merch_id')
      ]
    ]);

    $var = json_decode($form_post->getBody()->getContents());

    if($var->success == true)
    {
      $this->attrib = $var->result;

      return $this->attrib;
    }
    else
    {
      return Redirect::back()->withInput()->withErrors($var->message);
    }
  }


}
