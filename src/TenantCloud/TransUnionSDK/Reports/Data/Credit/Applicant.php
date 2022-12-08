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
		public ?array $addresses,
		public ?array $akas,
		public ?array $collections,
		public mixed $consumerRightsStatements,
		public mixed $consumerStatement,
		public ?array $employments,
		public ?string $fileNumber,
		public ?FileSummary $fileSummary,
		public ?string $firstName,
		public ?array $fraudIndicators,
		public mixed $incomeEstimate,
		public ?array $inquirySubscriber,
		public ?string $lastName,
		public ?string $middleName,
		public mixed $ofac,
		public ?array $phones,
		public ?ProfileSummary $profileSummary,
		public ?array $publicRecords,
		public ?Carbon $reportRetrievedOn,
		public ?string $sSNMessage,
		public ?ScoreModel $scoreModel,
		public ?Status $status,
		public ?string $suffix,
		public ?array $tradelines
	) {
	}

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
				'reportRetrievedOn'        => [
					fn (Carbon $date) => $date->isoFormat('YYYY-MM-DD[T]HH:mm:ss.SSSSSSSZ'),
				],
			]
		);
	}
}
