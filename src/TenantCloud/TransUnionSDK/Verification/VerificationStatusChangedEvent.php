<?php

namespace TenantCloud\TransUnionSDK\Verification;

/**
 * Dispatched when verification status is changed on TU side.
 */
final class VerificationStatusChangedEvent
{
	public function __construct(public int $screeningRequestRenterId, public ManualVerificationStatus $status)
	{
	}
}
