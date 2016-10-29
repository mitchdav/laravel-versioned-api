<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		/** @var \Dingo\Api\Transformer\Factory $factory */
		$factory = $this->app['Dingo\Api\Transformer\Factory'];
		
		$factory->setAdapter(
			function ()
			{
				$fractal = new \League\Fractal\Manager;
				
				$fractal->setSerializer(new \App\Serializers\NoDataArraySerializer);
				
				return new \Dingo\Api\Transformer\Adapter\Fractal($fractal);
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
