<?php

namespace App\API\V3\Controllers;

use App\API\V3\Transformers\UserTransformer;

class UserController extends APIController
{
	public function me()
	{
		return $this->response->item($this->getUser(), new UserTransformer());
	}
}