<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Address;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Aka;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Collection;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Employment;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FileSummary;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\FraudIndicator;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Inquire;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ProfileSummary;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\PublicRecord;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\ScoreModel;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Tradeline;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Applicant implements ArraySerializable
{
	use MagicArraySerializable;

	/**
	 * @param Address[]           $addresses
	 * @param Aka[]               $akas
	 * @param Collection[]|null   $collections
	 * @param Employment[]        $employments
	 * @param FraudIndicator[]    $fraudIndicators
	 * @param Inquire[]|null      $inquirySubscriber
	 * @param string[]            $phones
	 * @param PublicRecord[]|null $publicRecords
	 * @param Tradeline[]|null    $tradelines
	 */
	public function __construct(
		public readonly ?array $addresses,
		public readonly ?array $akas,
		public readonly ?array $collections,
		public readonly mixed $consumerRightsStatements,
		public readonly mixed $consumerStatement,
		public readonly ?array $employments,
		public readonly ?string $fileNumber,
		public readonly ?FileSummary $fileSummary,
		public readonly ?string $firstName,
		public readonly ?array $fraudIndicators,
		public readonly mixed $incomeEstimate,
		public readonly ?array $inquirySubscriber,
		public readonly ?string $lastName,
		public readonly ?string $middleName,
		public readonly mixed $ofac,
		public readonly ?array $phones,
		public readonly ?ProfileSummary $profileSummary,
		public readonly ?array $publicRecords,
		public readonly ?Carbon $reportRetrievedOn,
		public readonly ?string $sSNMessage,
		public readonly ?ScoreModel $scoreModel,
		public readonly ?Status $status,
		public readonly ?string $suffix,
		public readonly ?array $tradelines
	) {}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'addresses'         => Address::class,
				'akas'              => Aka::class,
				'collections'       => Collection::class,
				'employments'       => Employment::class,
				'fraudIndicators'   => FraudIndicator::class,
				'inquirySubscriber' => Inquire::class,
				'phones'            => 'string',
				'publicRecords'     => PublicRecord::class,
				'tradelines'        => Tradeline::class,
			],
			[
				'consumerRightsStatements' => ArraySerializationConfig::mixedCustomSerializer(),
				'consumerStatement'        => ArraySerializationConfig::mixedCustomSerializer(),
				'incomeEstimate'           => ArraySerializationConfig::mixedCustomSerializer(),
				'ofac'                     => ArraySerializationConfig::mixedCustomSerializer(),
			]
		);
	}
}
