<?php

namespace App\Providers\Traits;

use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Route;

trait AuthServiceProvider
{
	/** @var Authenticatable $user */
	private $user;
	
	/**
	 * Get the currently authenticated user.
	 *
	 * @return Authenticatable
	 */
	public function user()
	{
		return $this->user;
	}
	
	public function retrieveById($identifier)
	{
		return $this->byId($identifier);
	}
	
	public function retrieveByCredentials(array $credentials)
	{
		return $this->byCredentials($credentials);
	}
	
	public function authenticate(Request $request, Route $route)
	{
		$this->validateAuthorizationHeader($request);
	}
	
	public function getAuthorizationMethod()
	{
		return 'bearer';
	}
	
	public function retrieveByToken($identifier, $token)
	{
		
	}
	
	public function updateRememberToken(Authenticatable $user, $token)
	{
		
	}
}