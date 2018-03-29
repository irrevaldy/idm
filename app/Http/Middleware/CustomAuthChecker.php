<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Session;

class CustomAuthChecker
{
    public function handle($request, Closure $next, $guard = null)
    {
        if(empty(Session::get('username')) && empty(Session::get('apitoken'))){
			//abort(403);
			return redirect('/');
		}
		else{
			$client = new \GuzzleHttp\Client();
			$form_post = $client->request('GET', config('constants.api_server').'user/'.Session::get('username'));

			$var = json_decode($form_post->getBody()->getContents());
			$token = $var->data->api_token;

			if(Session::get('apitoken') != $token){
				Session::flush();
				//abort(403);
				return redirect('/');
			}
			else{
				return $next($request);
			}
		}
    }
}
