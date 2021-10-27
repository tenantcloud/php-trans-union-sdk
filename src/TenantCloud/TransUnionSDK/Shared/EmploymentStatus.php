<?php

namespace TenantCloud\TransUnionSDK\Shared;

use TenantCloud\Standard\Enum\ValueEnum;

/**
 * @extends ValueEnum<string>
 */
final class EmploymentStatus extends ValueEnum
{
	public static self $NOT_EMPLOYED;

	public static self $EMPLOYED;

	public static self $SELF_EMPLOYED;

	public static self $STUDENT;

	protected static function initializeInstances(): void
	{
		self::$NOT_EMPLOYED = new self('NotEmployed');
		self::$EMPLOYED = new self('Employed');
		self::$SELF_EMPLOYED = new self('SelfEmployed');
		self::$STUDENT = new self('Student');
	}
}
