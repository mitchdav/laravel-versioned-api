<?php

namespace App\Adapters;

use App\Guards\JWTGuard;
use Illuminate\Auth\AuthManager;
use Tymon\JWTAuth\Providers\Auth\AuthInterface;

class AuthAdapter implements AuthInterface
{
	/**
	 * @var AuthInterface $provider
	 */
	protected $provider;
	
	/**
	 * @param AuthManager $auth
	 */
	public function __construct(AuthManager $auth)
	{
		/** @var JWTGuard $guard */
		$guard = $auth->guard('api');
		
		$this->provider = $guard->getProvider();
	}
	
	/**
	 * Check a user's credentials.
	 *
	 * @param  array $credentials
	 *
	 * @return bool
	 */
	public function byCredentials(array $credentials = [])
	{
		return $this->provider->byCredentials($credentials);
	}
	
	/**
	 * Authenticate a user via the id.
	 *
	 * @param  mixed $id
	 *
	 * @return bool
	 */
	public function byId($id)
	{
		return $this->provider->byId($id);
	}
	
	/**
	 * Get the currently authenticated user.
	 *
	 * @return mixed
	 */
	public function user()
	{
		return $this->provider->user();
	}
}
