<?php

namespace App\API\V2\Providers;

use App\API\V2\Entities\User;
use App\API\V2\Repositories\UserRepository;
use Doctrine\ORM\EntityManager;
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
		/** @var EntityManager $em */
		$em = $this->app['em'];
		
		$this->app->bind(
			UserRepository::class,
			function () use ($em)
			{
				return new UserRepository(
					$em,
					$em->getClassMetadata(User::class)
				);
			}
		);
	}
}