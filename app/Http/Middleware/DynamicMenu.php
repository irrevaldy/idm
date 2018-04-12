<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Session;

class DynamicMenu
{
	public $attributes;

    public function handle($request, Closure $next, $guard = null)
    {
		if(empty(Session::get('username')) && empty(Session::get('apitoken'))){
			abort(403);
		}
		else{
			$client = new \GuzzleHttp\Client();
			$form_post = $client->request('GET', config('constants.api_server').'user/'.Session::get('username'));

			$var = json_decode($form_post->getBody()->getContents());
			$token = $var->data->api_token;

			//return $apitoken;

			if(Session::get('apitoken') != $token){
				Session::flush();
				abort(403);
			}
			else{
				$client = new \GuzzleHttp\Client();
				$get_main_menu = $client->request('GET', config('constants.api_server').'menu/main/'.Session::get('group_id').'/'.Session::get('user_id').'/'.Session::get('apitoken'));
				$main_menu = json_decode($get_main_menu->getBody()->getContents());
				$main_menu = $main_menu->data;

				$get_sub_menu = $client->request('GET', config('constants.api_server').'menu/regular/'.Session::get('group_id').'/'.Session::get('user_id').'/'.Session::get('apitoken'));
				$sub_menu = json_decode($get_sub_menu->getBody()->getContents());
				$sub_menu = $sub_menu->data;

				$request->attributes->add(['main_menu' => $main_menu]);
				$request->attributes->add(['sub_menu' => $sub_menu]);

				return $next($request);
			}
		}
    }
}
