<?php

namespace TenantCloud\TransUnionSDK\Exams;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;

/**
 * @method self setRequestRenterId(int $idOrRenter)
 * @method int  getRequestRenterId()
 * @method bool hasRequestRenterId()
 * @method self setPerson(RequestExamPersonDTO $person)
 */
final class RequestExamDTO extends CamelDataTransferObject
{
	protected array $fields = [
		'requestRenterId',
		'externalReferenceNumber',
		'person',
	];
}
