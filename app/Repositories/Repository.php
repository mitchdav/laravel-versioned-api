<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class Repository extends EntityRepository
{
	protected $entity;
	
	public function __construct()
	{
		if($this->entity == NULL)
		{
			throw new \Exception('All repositories must specify which entity they are providing a repository for.');
		}
		
		/** @var EntityManager $em */
		$em = app('em');
		
		parent::__construct($em, $em->getClassMetadata($this->entity));
		
		$this->excludeDeleted();
	}
	
	public function excludeDeleted()
	{
		$this->getEntityManager()->getFilters()->enable('deletable');
		
		return $this;
	}
	
	public function includeDeleted()
	{
		$this->getEntityManager()->getFilters()->disable('deletable');
		
		return $this;
	}
}