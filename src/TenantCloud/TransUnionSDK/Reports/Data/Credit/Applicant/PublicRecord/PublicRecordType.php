<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\PublicRecord;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class PublicRecordType extends ValueEnum
{
	public static self $bankruptcies; //bankruptcies = 'BANKRUPTCIES',

	public static self $judgements; //judgements = 'JUDGEMENTS',

	protected static function initializeInstances(): void
	{
		self::$bankruptcies = new self('BANKRUPTCIES');
		self::$judgements = new self('JUDGEMENTS');
	}
}
