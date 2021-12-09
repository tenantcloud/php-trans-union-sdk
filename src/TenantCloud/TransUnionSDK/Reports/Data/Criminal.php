<?php

namespace TenantCloud\TransUnionSDK\Reports\Data;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal\Disclaimer;
use TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;
use TenantCloud\TransUnionSDK\Reports\Data\Shared\RequestConsumer;

final class Criminal
{
	public int $sexOffenderIdentityCount;

	public RequestConsumer $requestedConsumer;

	public string $permissiblePurpose;

	public int $otherIdentityCount;

	public int $oFACIdentityCount;

	public int $mostWantedIdentityCount;

	/** @var Identity[] */
	public array $identities;

	/** @var Disclaimer[] */
	public array $disclaimers;

	public int $criminalIdentityCount;

	public Carbon $createdOn;

	/**
	 * @param Disclaimer[] $disclaimers
	 * @param Identity[]   $identities
	 */
	public function __construct(
		Carbon $createdOn,
		int $criminalIdentityCount,
		array $disclaimers,
		array $identities,
		int $mostWantedIdentityCount,
		int $oFACIdentityCount,
		int $otherIdentityCount,
		string $permissiblePurpose,
		RequestConsumer $requestedConsumer,
		int $sexOffenderIdentityCount
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
