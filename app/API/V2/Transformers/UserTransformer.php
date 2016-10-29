<?php

namespace App\API\V2\Transformers;

use App\API\V2\Entities\User as Entity;

use App\Transformers\Transformer;

class UserTransformer extends Transformer
{
	/**
	 * @param Entity $entity
	 *
	 * @return array
	 */
	protected $availableIncludes = array();
	
	/**
	 * @param Entity $entity
	 *
	 * @return array
	 */
	public function transform(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return array(
				'id'    => $entity->getId(),
				'email' => $entity->getEmail(),
				'name'  => $entity->getName(),
			);
		}
		
		else
		{
			return array();
		}
	}
}