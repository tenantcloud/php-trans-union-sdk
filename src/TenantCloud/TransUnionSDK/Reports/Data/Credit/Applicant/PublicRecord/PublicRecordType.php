<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\PublicRecord;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class PublicRecordType extends ValueEnum
{
	public static self $BANKRUPTCIES;

	public static self $JUDGEMENTS;

	protected static function initializeInstances(): void
	{
		self::$BANKRUPTCIES = new self('BANKRUPTCIES');
		self::$JUDGEMENTS = new self('JUDGEMENTS');
	}
}
