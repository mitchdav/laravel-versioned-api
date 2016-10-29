<?php
namespace App\Entities\Filters;

use App\Entities\Traits\Deletable;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class DeletableFilter extends SQLFilter
{
	public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
	{
		if(hasTrait($targetEntity->getReflectionClass()->getName(), Deletable::class) == TRUE)
		{
			return $targetTableAlias . '.deleted = FALSE';
		}
		
		else
		{
			return '';
		}
	}
}