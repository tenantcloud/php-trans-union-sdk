<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

class CreditDataStatus
{
	public bool $disputedSpecified;

	public bool $disputed;

	public CreditDataStatusDoNotPromote $doNotPromote;

	public CreditDataStatusFreeze $freeze;

	public bool $minor;

	public bool $minorSpecified;

	public bool $suppressed;

	public bool $suppressedSpecified;

	public function __construct(
		bool $disputed,
		bool $disputedSpecified,
		CreditDataStatusDoNotPromote $doNotPromote,
		CreditDataStatusFreeze $freeze,
		bool $minor,
		bool $minorSpecified,
		bool $suppressed,
		bool $suppressedSpecified
	) {
	}
}
