<?php

namespace TenantCloud\TransUnionSDK\Reports\Data;

use TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\PermissiblePurpose;
use TenantCloud\TransUnionSDK\Reports\Data\Credit\TransactionsControl;
use TenantCloud\TransUnionSDK\Reports\Data\Shared\RequestConsumer;

final class Credit
{
	public string $version;

	public TransactionsControl $transactionControl;

	public int $searchStatus;

	public RequestConsumer $requestedConsumer;

	public PermissiblePurpose $permissiblePurpose;

	public string $entityID;

	public int $document;

	public string $consumerId;

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
		string $consumerId,
		int $document,
		string $entityID,
		PermissiblePurpose $permissiblePurpose,
		RequestConsumer $requestedConsumer,
		int $searchStatus,
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
