<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Enums;

use TenantCloud\Standard\Enum\ValueEnum;

class AccountType extends ValueEnum
{
	public static self $installment; //installment = 'Installment',

	public static self $revolving; //revolving = 'Revolving',

	public static self $mortgage; //mortgage = 'Mortgage',

	public static self $open; //open = 'Open',

	protected static function initializeInstances(): void
	{
		self::$installment = new self('Installment');
		self::$revolving = new self('Revolving');
		self::$mortgage = new self('Mortgage');
		self::$open = new self('Open');
	}
}
