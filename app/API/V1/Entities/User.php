<?php

namespace App\API\V1\Entities;

use App\Entities\Traits\Deletable;
use App\Entities\User as UserEntity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="App\API\V1\Repositories\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends UserEntity
{
	use Deletable;
}