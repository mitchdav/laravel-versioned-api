<?php

namespace App\API\V3\Entities;

use App\Entities\Traits\Deletable;
use App\Entities\User as UserEntity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="App\API\V3\Repositories\UserRepository")
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
	 * @ORM\Column(name="job", type="string")
	 * @var string $job
	 */
	protected $job;
	
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
	
	/**
	 * @return string
	 */
	public function getJob()
	{
		return $this->job;
	}
	
	/**
	 * @param string $job
	 *
	 * @return $this
	 */
	public function setJob($job)
	{
		$this->job = $job;
		
		return $this;
	}
}