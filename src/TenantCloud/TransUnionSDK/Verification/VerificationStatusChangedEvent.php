<?php

namespace TenantCloud\TransUnionSDK\Verification;

/**
 * Dispatched when verification status is changed on TU side.
 */
final class VerificationStatusChangedEvent
{
	/** @var int */
	public $screeningRequestRenterId;

	/** @var ManualVerificationStatus */
	public $status;

	public function __construct(int $screeningRequestRenterId, ManualVerificationStatus $status)
	{
		$this->screeningRequestRenterId = $screeningRequestRenterId;
		$this->status = $status;
	}

	/**
	 * Those exist because {@see ManualVerificationStatus} is not serializable.
	 *
	 * @return array<string, mixed>
	 */
	public function __serialize(): array
	{
		return [
			'screeningRequestRenterId' => $this->screeningRequestRenterId,
			'status'                   => $this->status->value(),
		];
	}

	/**
	 * Those exist because {@see ManualVerificationStatus} is not serializable.
	 *
	 * @param array<string, mixed> $data
	 */
	public function __unserialize(array $data): void
	{
		$this->screeningRequestRenterId = $data['screeningRequestRenterId'];
		$this->status = ManualVerificationStatus::fromValue($data['status']);
	}
}
