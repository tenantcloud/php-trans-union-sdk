<?php

namespace TenantCloud\TransUnionSDK\Reports;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;

/**
 * @method self setRequestRenterId(int $id)
 * @method self setPerson(RequestReportPersonDTO $person)
 * @method int  getRequestRenterId()
 */
final class RequestReportDTO extends CamelDataTransferObject
{
	/** @inheritDoc */
	protected array $fields = [
		'requestRenterId',
		'person',
	];
}
