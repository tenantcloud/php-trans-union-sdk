<?php

namespace TenantCloud\TransUnionSDK\Reports;

use TenantCloud\Standard\Enum\ValueEnum;
use TenantCloud\TransUnionSDK\Reports\Data\Credit;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal;
use TenantCloud\TransUnionSDK\Reports\Data\Eviction;

/**
 * @template-covariant ReportType
 *
 * @extends ValueEnum<string>
 */
final class ReportProduct extends ValueEnum
{
	/** @var self<Criminal> */
	public static self $CRIMINAL;

	/** @var self<Eviction> */
	public static self $EVICTION;

	/** @var self<Credit> */
	public static self $CREDIT;

	/**
	 * @inheritDoc
	 */
	protected static function initializeInstances(): void
	{
		self::$CRIMINAL = new self('Criminal');
		self::$EVICTION = new self('Eviction');
		self::$CREDIT = new self('Credit');
	}
}
