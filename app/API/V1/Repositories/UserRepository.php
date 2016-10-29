<?php

namespace App\API\V1\Repositories;

use App\Repositories\Repository;

class UserRepository extends Repository
{
	protected $entity = \App\API\V1\Entities\User::class;
}