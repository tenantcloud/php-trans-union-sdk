<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class PermissiblePurpose extends ValueEnum
{
	public static self $TENANT_SCREENING;

	protected static function initializeInstances(): void
	{
		self::$TENANT_SCREENING = new self('TenantScreening');
	}
}
