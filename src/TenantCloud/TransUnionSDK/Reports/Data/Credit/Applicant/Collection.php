<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Collection implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?string $accountDesignator,
		public readonly ?string $accountNumber,
		public readonly ?string $accountType,
		public readonly ?string $collectionAgencyName,
		public readonly ?string $collectionComments,
		public readonly ?string $creditorsName,
		public readonly ?float $currentBalance,
		public readonly ?string $currentMOP,
		public readonly ?string $customerNumber,
		public readonly ?Carbon $dateClosed,
		public readonly ?string $dateClosedIndicator,
		public readonly ?Carbon $dateOpened,
		public readonly ?Carbon $datePaidOut,
		public readonly ?Carbon $dateReported,
		public readonly ?Carbon $dateVerified,
		public readonly ?float $highCredit,
		public readonly ?string $industryCode,
		public readonly ?string $loanType,
		public readonly ?string $narrativeCode1,
		public readonly ?string $narrativeCode2,
		public readonly ?float $pastDue,
		public readonly ?string $remarksCode,
		public readonly ?string $verificationIndicator
	) {
	}
}
