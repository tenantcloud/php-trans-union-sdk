<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\PublicRecord\PublicRecordType;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class PublicRecord implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?string $accountDesignator,
		public ?float $amount,
		public ?float $assetAmount,
		public ?string $courtLocationCity,
		public ?string $courtLocationState,
		public ?string $courtType,
		public ?string $courtCode,
		public ?Carbon $dateFiled,
		public ?Carbon $dateFiledOriginal,
		public ?Carbon $dateReported,
		public ?Carbon $dateSettled,
		public ?Carbon $dateVerified,
		public ?string $defendant,
		public ?string $dispositionCode,
		public ?string $industryCode,
		public ?string $intendedDispositionCode,
		public ?string $legalDesignator,
		public ?float $liabilitiesAmount,
		public ?string $lienClass,
		public ?string $memberCode,
		public ?string $narrativeCode1,
		public ?string $narrativeCode2,
		public ?string $plaintiff,
		public ?PublicRecordType $publicRecordType,
		public ?string $recordCode,
		public ?string $referenceNumber,
		public ?string $statusCode,
		public ?string $typeOfBankruptcy
	) {
	}
}
