# Laravel Versioned API

This is a skeleton for the [Laravel](https://laravel.com/) framework which takes care of setting up a new project with [Doctrine](http://www.laraveldoctrine.org/), [Dingo](https://github.com/dingo/api) and [JWT](https://github.com/tymondesigns/jwt-auth). After installation you will have a working REST API which responds to requests for 3 different versions of the same API, and has authentication already built-in.

## Requirements
* PHP >= 5.5.9
* A database (MySQL, or any others supported by Laravel and Doctrine)
* [Composer](https://getcomposer.org/).

## Dependencies
You have two options to get the skeleton setup:

1. Utilise Composer's create-project command by running the following command in the terminal:

		composer create-project mitchdav/laravel-versioned-api
1. Or clone the repo manually by running the following commands in the terminal:

		git clone https://github.com/mitchdav/laravel-versioned-api.git
		cd laravel-versioned-api
		composer install
		php -r "copy('.env.example', '.env');"
		php artisan key:generate
		php artisan jwt:generate

This will setup the project's dependencies, however you will still need to setup the database. You must first create a MySQL database, and then store its details in the .env file like so:

	DB_DATABASE=mydatabase
    DB_USERNAME=root
    DB_PASSWORD=

To then setup the database we use Doctrine's helper command to build our schema and proxies.

	php artisan doctrine:schema:create
	php artisan doctrine:generate:proxies
	
The system is now ready to receive requests made against it, however we don't have any users to login to the API with. To generate a test user, run the following command:

	php artisan db:seed

This will output an email address and password you can use to login.

## Logging In
Make a POST request to ```/auth/authenticate``` with ```Content-Type``` set to ```application/json```. The JSON structure should look like the following:
	
	{
	    "email": "{email address from previous command}",
	    "password": "{password from previous command}"
	}

If the response is successful, you will receive a token which you can use to make subsequent requests to the server, while remaining authenticated as the given user. To send through the token value send it in the ```Authorization``` header as follows:

	Authorization: Bearer {token}
	
To retrieve the user details make a GET request to ```/auth/me``` and you will receive a request similar to the following:

    {
        "id": 1,
        "email": "theodora39@example.net",
        "name": "Dillon Effertz",
        "job": "Roofer"
    }

For further information about making requests to the server check the [Dingo API Wiki](https://github.com/dingo/api/wiki).
	
## Developing The Server
As you make changes to the entities, you need to generate proxies for your entities, so that the system can load quickly for each request. To do this, run the following command in the terminal:

	php artisan doctrine:generate:proxies

This will not be necessary unless you modify the entities as their proxies are already generated and committed.

If your changes to an entity modify its database structure, you can persist this to the database by running the following command in the terminal:

	php artisan doctrine:schema:update

## Routes
Routes for your versions are available by looking at the [routes file](https://github.com/mitchdav/laravel-versioned-api/blob/master/app/Http/routes.php).

## Adding New Versions
The important files are all contained in the ```app/API``` folder. The project has 3 different versions of the same API, which is kept very simple to be as extendable as possible.

When you would like to add a new version, you will need to follow this process:

1. Copy the whole previous version's folder into the ```app/API``` folder and give it a suitable name (for example, copy the ```app/API/V3``` folder to ```app/API/V4```)
1. Do a search and replace operation to update the folder's references from the previous version to the new version (for example, update all instances of ```V3``` to ```V4``` within the ```V4``` folder)
1. Copy any existing routes from the previous version to the new version in the routes file
1. Update the ```config/api.php``` file to include the new version in the ```auth``` section
1. Update the ```.env``` file's ```API_VERSION``` variable to the new version
1. Make your changes to the API's new version (for example, add a new entity, or a field to an existing entity)
1. Run the following commands to update the database schema and proxies

		php artisan doctrine:generate:proxies
		php artisan doctrine:schema:update
1. Add routes to any new endpoints in the routes file

## Removing Versions
To remove a version follow this process:

1. Remove the version's folder inside the ```app/API``` folder
1. Remove the routes for the removed version from the routes file
1. Remove the ```auth``` entry in the ```config/api.php``` file
1. Check that the ```.env``` file's ```API_VERSION``` variable is not set to the removed version