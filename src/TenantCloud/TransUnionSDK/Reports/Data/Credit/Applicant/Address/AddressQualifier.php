<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Address;

use TenantCloud\Standard\Enum\ValueEnum;

final class AddressQualifier extends ValueEnum
{
	public static self $currentAddress; //currentAddress = 'Current Address',

	public static self $previousAddress; //previousAddress = 'Previous Address',

	public static self $secondPreviousAddress; //secondPrevious = 'Second Previous',

	protected static function initializeInstances(): void
	{
		self::$currentAddress = new self('Current Address');
		self::$previousAddress = new self('Previous Address');
		self::$secondPreviousAddress = new self('Second Previous Address');
	}
}
