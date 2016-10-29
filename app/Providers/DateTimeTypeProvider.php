<?php

namespace App\Providers;

use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\ConversionException;

use Doctrine\DBAL\Platforms\AbstractPlatform;

class DateTimeTypeProvider extends DateTimeType
{
	const DATETIME_FORMAT = 'Y-m-d H:i:s';

	/**
	 * {@inheritdoc}
	 */
	public function convertToDatabaseValue($value, AbstractPlatform $platform)
	{
		return ($value !== null)
			? $value->setTimezone(new \DateTimeZone(config('app.timezone')))->format($this::DATETIME_FORMAT) : null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		if ($value === null || $value instanceof \DateTime) {
			return $value;
		}

		$val = \DateTime::createFromFormat($platform->getDateTimeFormatString(), $value);

		if ( ! $val) {
			$val = date_create($value);
		}

		if ( ! $val) {
			throw ConversionException::conversionFailedFormat($value, $this->getName(), $platform->getDateTimeFormatString());
		}

		return $val;
	}
}