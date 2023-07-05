<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class TransactionsControlOptions implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public readonly ?bool $contractualRelationshipSpecified,
		public readonly ?bool $countrySpecified,
		public readonly ?bool $languageSpecified,
		public readonly ?bool $pointOfSaleIndicatorSpecified,
		public readonly ?bool $processingEnvironmentSpecified
	) {}
}
