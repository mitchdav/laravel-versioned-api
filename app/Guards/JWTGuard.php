<?php

namespace App\Guards;

use Illuminate\Auth\TokenGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class JWTGuard extends TokenGuard
{
	public function __construct(UserProvider $provider)
	{
		parent::__construct($provider, new Request());
	}
	
	/**
	 * @return UserProvider
	 */
	public function getProvider()
	{
		return $this->provider;
	}
}
