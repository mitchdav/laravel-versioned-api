<?php

namespace App\API\V1\Controllers;

use App\API\V1\Transformers\UserTransformer;

class UserController extends APIController
{
	public function me()
	{
		return $this->response->item($this->getUser(), new UserTransformer());
	}
}