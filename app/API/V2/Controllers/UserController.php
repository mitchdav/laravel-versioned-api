<?php

namespace App\API\V2\Controllers;

use App\API\V2\Transformers\UserTransformer;

class UserController extends APIController
{
	public function me()
	{
		return $this->response->item($this->getUser(), new UserTransformer());
	}
}