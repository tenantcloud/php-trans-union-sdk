<?php

namespace TenantCloud\TransUnionSDK\Reports\Data;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\PermissiblePurpose;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl;
use TenantCloud\TransUnionSDK\Reports\Data\Shared\RequestConsumer;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;
use Tests\TenantCloud\TransUnionSDK\Reports\Data\CreditTest;

/**
 * @see CreditTest
 */
final class Credit implements ArraySerializable
{
	use MagicArraySerializable;

	/**
	 * @param Applicant[] $applicants
	 */
	public function __construct(
		public ?array $applicants,
		public mixed $bureau,
		public ?string $componentIdentifier,
		public ?string $consumerId,
		public ?int $document,
		public ?string $entityID,
		public ?PermissiblePurpose $permissiblePurpose,
		public ?RequestConsumer $requestedConsumer,
		public ?int $searchStatus,
		public ?TransactionsControl $transactionControl,
		public ?string $version
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'applicants' => Applicant::class,
			],
			[
				'bureau' => ArraySerializationConfig::mixedCustomSerializer(),
			]
		);
	}
}
