<?php

namespace App\API\V3\Repositories;

use App\Repositories\Repository;

class UserRepository extends Repository
{
	protected $entity = \App\API\V3\Entities\User::class;
}