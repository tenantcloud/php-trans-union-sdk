<?php

namespace TenantCloud\TransUnionSDK\Shared;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class PhoneType extends ValueEnum
{
	public static self $MOBILE;

	protected static function initializeInstances(): void
	{
		self::$MOBILE = new self('Mobile');
	}
}
