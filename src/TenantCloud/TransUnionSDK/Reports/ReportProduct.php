<?php

namespace TenantCloud\TransUnionSDK\Reports;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class ReportProduct extends ValueEnum
{
	public static self $CRIMINAL;

	public static self $EVICTION;

	public static self $CREDIT;

	/**
	 * {@inheritdoc}
	 */
	protected static function initializeInstances(): void
	{
		self::$CRIMINAL = new self('Criminal');
		self::$EVICTION = new self('Eviction');
		self::$CREDIT = new self('Credit');
	}
}
