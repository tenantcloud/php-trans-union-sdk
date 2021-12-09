<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Enums;

use TenantCloud\Standard\Enum\ValueEnum;

class PermissiblePurpose extends ValueEnum
{
	public static self $tenantScreening; //tenantScreening = 'TenantScreening',

	protected static function initializeInstances(): void
	{
		self::$tenantScreening = new self('TenantScreening');
	}
}
