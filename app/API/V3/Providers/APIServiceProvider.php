<?php

namespace App\API\V3\Providers;

use Illuminate\Auth\AuthManager;
use Illuminate\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider
{
	/**
	 * @param \Illuminate\Auth\AuthManager $authManager
	 */
	public function boot(AuthManager $authManager)
	{
		$authManager
			->provider(
				'api',
				function ()
				{
					return new AuthServiceProvider();
				}
			);
	}
	
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		
	}
}