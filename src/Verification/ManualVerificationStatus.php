<?php

namespace TenantCloud\TransUnionSDK\Verification;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

/**
 * Possible statuses when TU verifies renter on their side manually.
 */
enum ManualVerificationStatus: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case AUTHENTICATED = 'UserAuthenticated';
}
