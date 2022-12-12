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
		public readonly ?array $applicants,
		public readonly mixed $bureau,
		public readonly ?string $componentIdentifier,
		public readonly ?string $consumerId,
		public readonly ?int $document,
		public readonly ?string $entityID,
		public readonly ?PermissiblePurpose $permissiblePurpose,
		public readonly ?RequestConsumer $requestedConsumer,
		public readonly ?int $searchStatus,
		public readonly ?TransactionsControl $transactionControl,
		public readonly ?string $version
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
