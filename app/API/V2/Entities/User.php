<?php

namespace App\API\V2\Entities;

use App\Entities\Traits\Deletable;
use App\Entities\User as UserEntity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="App\API\V2\Repositories\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends UserEntity
{
	use Deletable;
	
	/**
	 * @ORM\Column(name="name", type="string")
	 * @var string $name
	 */
	protected $name;
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @param string $name
	 *
	 * @return $this
	 */
	public function setName($name)
	{
		$this->name = $name;
		
		return $this;
	}
}