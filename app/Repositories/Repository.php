<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

class Repository extends EntityRepository
{
	public function __construct(EntityManager $em, ClassMetadata $class)
	{
		parent::__construct($em, $class);
		
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