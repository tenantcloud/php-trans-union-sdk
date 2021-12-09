<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit;

use TenantCloud\Standard\Enum\ValueEnum;

final class PermissiblePurpose extends ValueEnum
{
	public static self $tenantScreening; //tenantScreening = 'TenantScreening',

	protected static function initializeInstances(): void
	{
		self::$tenantScreening = new self('TenantScreening');
	}
}