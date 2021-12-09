<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Interfaces;

use TenantCloud\TransUnionSDK\Reports\Data\Enums\PermissiblePurpose;

class Credit
{
	public string $version;

	public TransactionsControl $transactionControl;

	public number $searchStatus;

	public RequestConsumer $requestedConsumer;

	public PermissiblePurpose $permissiblePurpose;

	public string $entityID;

	public number $document;

	public number $consumerId;

	public string $componentIdentifier;

	public $bureau;

	/** @var Applicant[] */
	public array $applicants;

	/**
	 * @param Applicant[] $applicants
	 * @param mixed       $bureau
	 */
	public function __construct(
		array $applicants,
		$bureau,
		string $componentIdentifier,
		number $consumerId,
		number $document,
		string $entityID,
		PermissiblePurpose $permissiblePurpose,
		RequestConsumer $requestedConsumer,
		number $searchStatus,
		TransactionsControl $transactionControl,
		string $version
	) {
		$this->applicants = $applicants;
		$this->bureau = $bureau;
		$this->componentIdentifier = $componentIdentifier;
		$this->consumerId = $consumerId;
		$this->document = $document;
		$this->entityID = $entityID;
		$this->permissiblePurpose = $permissiblePurpose;
		$this->requestedConsumer = $requestedConsumer;
		$this->searchStatus = $searchStatus;
		$this->transactionControl = $transactionControl;
		$this->version = $version;
	}
}
