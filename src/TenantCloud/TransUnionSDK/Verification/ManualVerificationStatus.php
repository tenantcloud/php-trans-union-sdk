<?php

namespace TenantCloud\TransUnionSDK\Verification;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * Possible statuses when TU verifies renter on their side manually.
 *
 * @extends ValueEnum<string>
 */
final class ManualVerificationStatus extends ValueEnum
{
	public static self $AUTHENTICATED;

	/**
	 * @inheritDoc
	 */
	protected static function initializeInstances(): void
	{
		self::$AUTHENTICATED = new self('UserAuthenticated');
	}
}
