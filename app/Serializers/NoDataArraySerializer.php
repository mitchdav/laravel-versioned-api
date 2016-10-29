<?php

namespace App\Serializers;

use League\Fractal\Serializer\ArraySerializer;

class NoDataArraySerializer extends ArraySerializer
{
	/**
	 * @param string $resourceKey
	 * @param array  $data
	 *
	 * @return array
	 */
	public function collection($resourceKey, array $data)
	{
		return ($resourceKey) ? [$resourceKey => $this->serializeData($data)] : $this->serializeData($data);
	}
	
	/**
	 * @param string $resourceKey
	 * @param array  $data
	 *
	 * @return array
	 */
	public function item($resourceKey, array $data)
	{
		return ($resourceKey) ? [$resourceKey => $this->serializeData($data)] : $this->serializeData($data);
	}

	/**
	 * @param array $data
	 *
	 * @return array
	 *
	 * @link http://stackoverflow.com/a/6088745
	 */
	private function serializeData(array $data)
	{
		$newData = array();

		foreach($data as $key => $value)
		{
			if(is_array($value))
			{
				$newData[$key] = $this->serializeData($value);
			}

			else
			{
				if($value instanceof \DateTime)
				{
					$newData[$key] = $value->format(DATE_ISO8601);
				}

				else
				{
					$newData[$key] = $value;
				}
			}

			unset($data[$key]);
		}

		return $newData;
	}
}