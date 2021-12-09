<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl;

final class TransactionsControlOptions
{
	public bool $processingEnvironmentSpecified;

	public bool $pointOfSaleIndicatorSpecified;

	public bool $languageSpecified;

	public bool $countrySpecified;

	public bool $contractualRelationshipSpecified;

	public function __construct(
		bool $contractualRelationshipSpecified,
		bool $countrySpecified,
		bool $languageSpecified,
		bool $pointOfSaleIndicatorSpecified,
		bool $processingEnvironmentSpecified
	) {
		$this->contractualRelationshipSpecified = $contractualRelationshipSpecified;
		$this->countrySpecified = $countrySpecified;
		$this->languageSpecified = $languageSpecified;
		$this->pointOfSaleIndicatorSpecified = $pointOfSaleIndicatorSpecified;
		$this->processingEnvironmentSpecified = $processingEnvironmentSpecified;
	}
}
