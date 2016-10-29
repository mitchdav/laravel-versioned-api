<?php

namespace App\API\V3\Controllers;

use Dingo\Api\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

use App;

class AuthController extends APIController
{
	/** @var JWTAuth $auth */
	protected $auth;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->auth = App::make(JWTAuth::class);
	}
	
	public function authenticate(Request $request)
	{
		$credentials = $request->only('email', 'password');
		
		try
		{
			if(($token = $this->auth->attempt($credentials)) == FALSE)
			{
				return response()->json(['error' => 'invalid_credentials'], 401);
			}
		} catch(JWTException $e)
		{
			return response()->json(['error' => 'could_not_create_token'], 500);
		}
		
		return response()->json(compact('token'));
	}
	
	public function refresh()
	{
		if($this->auth->getToken() == FALSE)
		{
			throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException('token_absent');
		}
		
		try
		{
			$token = $this->auth->refresh();
		} catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e)
		{
			throw new \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException('token_invalid');
		}
		
		return response()->json(compact('token'));
	}
}
