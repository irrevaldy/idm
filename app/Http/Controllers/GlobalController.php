<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
