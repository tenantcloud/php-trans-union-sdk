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
		public readonly ?string $accountDesignator,
		public readonly ?float $amount,
		public readonly ?float $assetAmount,
		public readonly ?string $courtLocationCity,
		public readonly ?string $courtLocationState,
		public readonly ?string $courtType,
		public readonly ?string $courtCode,
		public readonly ?Carbon $dateFiled,
		public readonly ?Carbon $dateFiledOriginal,
		public readonly ?Carbon $dateReported,
		public readonly ?Carbon $dateSettled,
		public readonly ?Carbon $dateVerified,
		public readonly ?string $defendant,
		public readonly ?string $dispositionCode,
		public readonly ?string $industryCode,
		public readonly ?string $intendedDispositionCode,
		public readonly ?string $legalDesignator,
		public readonly ?float $liabilitiesAmount,
		public readonly ?string $lienClass,
		public readonly ?string $memberCode,
		public readonly ?string $narrativeCode1,
		public readonly ?string $narrativeCode2,
		public readonly ?string $plaintiff,
		public readonly ?PublicRecordType $publicRecordType,
		public readonly ?string $recordCode,
		public readonly ?string $referenceNumber,
		public readonly ?string $statusCode,
		public readonly ?string $typeOfBankruptcy
	) {
	}
}
