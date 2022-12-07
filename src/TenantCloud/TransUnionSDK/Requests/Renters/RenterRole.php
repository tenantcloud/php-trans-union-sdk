<?php

namespace TenantCloud\TransUnionSDK\Requests\Renters;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class RenterRole extends ValueEnum
{
	public static self $APPLICANT;

	public static self $CO_SIGNER;

	/**
	 * @inheritDoc
	 */
	protected static function initializeInstances(): void
	{
		self::$APPLICANT = new self('Applicant');
		self::$CO_SIGNER = new self('CoSigner');
	}
}
