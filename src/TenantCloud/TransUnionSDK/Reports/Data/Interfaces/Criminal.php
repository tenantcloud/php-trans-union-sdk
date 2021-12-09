<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use Carbon\Carbon;

class Criminal
{
	public number $sexOffenderIdentityCount;

	public RequestConsumer $requestedConsumer;

	public string $permissiblePurpose;

	public number $otherIdentityCount;

	public number $oFACIdentityCount;

	public number $mostWantedIdentityCount;

	/** @var Identity[] */
	public array $identities;

	/** @var Disclaimer[] */
	public array $disclaimers;

	public number $criminalIdentityCount;

	public Carbon $createdOn;

	/**
	 * @param Disclaimer[] $disclaimers
	 * @param Identity[]   $identities
	 */
	public function __construct(
		Carbon $createdOn,
		number $criminalIdentityCount,
		array $disclaimers,
		array $identities,
		number $mostWantedIdentityCount,
		number $oFACIdentityCount,
		number $otherIdentityCount,
		string $permissiblePurpose,
		RequestConsumer $requestedConsumer,
		number $sexOffenderIdentityCount
	) {
		$this->createdOn = $createdOn;
		$this->criminalIdentityCount = $criminalIdentityCount;
		$this->disclaimers = $disclaimers;
		$this->identities = $identities;
		$this->mostWantedIdentityCount = $mostWantedIdentityCount;
		$this->oFACIdentityCount = $oFACIdentityCount;
		$this->otherIdentityCount = $otherIdentityCount;
		$this->permissiblePurpose = $permissiblePurpose;
		$this->requestedConsumer = $requestedConsumer;
		$this->sexOffenderIdentityCount = $sexOffenderIdentityCount;
	}
}
