<?php

namespace TenantCloud\TransUnionSDK\Reports;

/**
 * Dispatched when TU notifies us of change of reports delivery status for given request renter ID.
 */
final class ReportDeliveryStatusChangedEvent
{
	/** @var int */
	public $screeningRequestRenterId;

	/** @var ReportDeliveryStatus */
	public $status;

	public function __construct(int $screeningRequestRenterId, ReportDeliveryStatus $status)
	{
		$this->screeningRequestRenterId = $screeningRequestRenterId;
		$this->status = $status;
	}

	/**
	 * Those exist because {@see ReportDeliveryStatus} is not serializable.
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
	 * Those exist because {@see ReportDeliveryStatus} is not serializable.
	 *
	 * @param array<string, mixed> $data
	 */
	public function __unserialize(array $data): void
	{
		$this->screeningRequestRenterId = $data['screeningRequestRenterId'];
		$this->status = ReportDeliveryStatus::fromValue($data['status']);
	}
}
