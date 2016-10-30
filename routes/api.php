<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/** @var Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');

$api->version(
	'V1',
	[],
	function () use ($api)
	{
		$api->post('auth/authenticate', 'App\API\V1\Controllers\AuthController@authenticate');
		$api->get('auth/refresh', 'App\API\V1\Controllers\AuthController@refresh');
	}
);

$api->version(
	'V1',
	[
		'middleware' => 'api.auth',
		'provider'   => 'V1',
	],
	function () use ($api)
	{
		$api->get('auth/me', 'App\API\V1\Controllers\UserController@me');
	}
);

$api->version(
	'V2',
	[],
	function () use ($api)
	{
		$api->post('auth/authenticate', 'App\API\V2\Controllers\AuthController@authenticate');
		$api->get('auth/refresh', 'App\API\V2\Controllers\AuthController@refresh');
	}
);

$api->version(
	'V2',
	[
		'middleware' => 'api.auth',
		'provider'   => 'V2',
	],
	function () use ($api)
	{
		$api->get('auth/me', 'App\API\V2\Controllers\UserController@me');
	}
);

$api->version(
	'V3',
	[],
	function () use ($api)
	{
		$api->post('auth/authenticate', 'App\API\V3\Controllers\AuthController@authenticate');
		$api->get('auth/refresh', 'App\API\V3\Controllers\AuthController@refresh');
	}
);

$api->version(
	'V3',
	[
		'middleware' => 'api.auth',
		'provider'   => 'V3',
	],
	function () use ($api)
	{
		$api->get('auth/me', 'App\API\V3\Controllers\UserController@me');
	}
);