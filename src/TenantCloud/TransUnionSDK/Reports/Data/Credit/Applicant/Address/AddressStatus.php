<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Address;

use TenantCloud\Standard\Enum\ValueEnum;

final class AddressStatus extends ValueEnum
{
	public static self $current; //current = 'current',

	public static self $previous; //previous = 'previous',

	public static self $secondPrevious; //secondPrevious = 'secondPrevious',

	protected static function initializeInstances(): void
	{
		self::$current = new self('current');
		self::$previous = new self('previous');
		self::$secondPrevious = new self('secondPrevious');
	}
}
