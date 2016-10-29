<?php

namespace App\API\V2\Repositories;

use App\Repositories\Repository;

class UserRepository extends Repository
{
	protected $entity = \App\API\V2\Entities\User::class;
}