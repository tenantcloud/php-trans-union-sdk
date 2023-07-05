<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Tradeline;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum PaymentPatternItem: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case NOT_AVAILABLE = 'X';
	case COMPLETED = '1';
	case THIRTY = '2';
	case SIXTY = '3';
	case NINETY = '4';
	case ONE_HUNDRED_TWENTY = '5';

	public function displayValue(): string
	{
		return match ($this) {
			self::NOT_AVAILABLE      => 'N/A',
			self::COMPLETED          => 'I',
			self::THIRTY             => '30',
			self::SIXTY              => '60',
			self::NINETY             => '90',
			self::ONE_HUNDRED_TWENTY => '120',
		};
	}
}
