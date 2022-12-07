<?php

namespace TenantCloud\TransUnionSDK\Requests;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;

/**
 * @method self setLandlordId(int $id)
 * @method int  getLandlordId()
 * @method bool hasLandlordId()
 * @method self setPropertyId(int $id)
 * @method int  getPropertyId()
 * @method bool hasPropertyId()
 * @method self setInitialBundleId(int $id)
 * @method int  getInitialBundleId()
 * @method bool hasInitialBundleId()
 */
final class CreateRequestDTO extends CamelDataTransferObject
{
	/** @inheritDoc */
	protected array $fields = [
		'landlordId',
		'propertyId',
		'initialBundleId',
	];
}
