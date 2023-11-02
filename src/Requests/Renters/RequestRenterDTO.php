<?php

namespace TenantCloud\TransUnionSDK\Requests\Renters;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;

/**
 * @method RequestRenterStatus|null getRenterStatus()
 */
final class RequestRenterDTO extends CamelDataTransferObject
{
	protected array $fields = [
		'renterStatus',
	];

	public function setRenterStatus(string|RequestRenterStatus $status): self
	{
		return $this->set('renterStatus', $status instanceof RequestRenterStatus ? $status : RequestRenterStatus::tryFrom($status));
	}
}
