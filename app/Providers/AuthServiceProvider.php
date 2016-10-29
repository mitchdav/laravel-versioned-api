<?php

namespace App\Providers;

use App\Guards\JWTGuard;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * @param \Illuminate\Auth\AuthManager $authManager
	 */
	public function boot(AuthManager $authManager)
	{
		Auth::extend('jwt', function ($app, $name, array $config) {
			// Return an instance of Illuminate\Contracts\Auth\Guard...
			
			return new JWTGuard(Auth::createUserProvider($config['provider']));
		});
	}
}
