<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class TransactionsControlOptions implements ArraySerializable
{
	use MagicArraySerializable;

	public ?bool $processingEnvironmentSpecified;

	public ?bool $pointOfSaleIndicatorSpecified;

	public ?bool $languageSpecified;

	public ?bool $countrySpecified;

	public ?bool $contractualRelationshipSpecified;

	public function __construct(
		?bool $contractualRelationshipSpecified,
		?bool $countrySpecified,
		?bool $languageSpecified,
		?bool $pointOfSaleIndicatorSpecified,
		?bool $processingEnvironmentSpecified
	) {
		$this->contractualRelationshipSpecified = $contractualRelationshipSpecified;
		$this->countrySpecified = $countrySpecified;
		$this->languageSpecified = $languageSpecified;
		$this->pointOfSaleIndicatorSpecified = $pointOfSaleIndicatorSpecified;
		$this->processingEnvironmentSpecified = $processingEnvironmentSpecified;
	}
}
