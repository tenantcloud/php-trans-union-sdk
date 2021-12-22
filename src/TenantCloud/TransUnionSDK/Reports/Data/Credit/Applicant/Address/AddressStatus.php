<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Address;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class AddressStatus extends ValueEnum
{
	public static self $CURRENT;

	public static self $PREVIOUS;

	public static self $SECOND_PREVIOUS;

	protected static function initializeInstances(): void
	{
		self::$CURRENT = new self('current');
		self::$PREVIOUS = new self('previous');
		self::$SECOND_PREVIOUS = new self('secondPrevious');
	}
}
