<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Collection implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $accountDesignator,
		public ?string $accountNumber,
		public ?string $accountType,
		public ?string $collectionAgencyName,
		public ?string $collectionComments,
		public ?string $creditorsName,
		public ?float $currentBalance,
		public ?string $currentMOP,
		public ?string $customerNumber,
		public ?Carbon $dateClosed,
		public ?string $dateClosedIndicator,
		public ?Carbon $dateOpened,
		public ?Carbon $datePaidOut,
		public ?Carbon $dateReported,
		public ?Carbon $dateVerified,
		public ?float $highCredit,
		public ?string $industryCode,
		public ?string $loanType,
		public ?string $narrativeCode1,
		public ?string $narrativeCode2,
		public ?float $pastDue,
		public ?string $remarksCode,
		public ?string $verificationIndicator
	) {
	}
}
