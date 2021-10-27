<?php

namespace TenantCloud\TransUnionSDK\Requests\Renters;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;

/**
 * @method self setRequestId(int $id)
 * @method int  getRequestId()
 * @method bool hasRequestId()
 * @method self setLandlordId(int $id)
 * @method int  getLandlordId()
 * @method bool hasLandlordId()
 * @method self setRenterId(int $id)
 * @method int  getRenterId()
 * @method bool hasRenterId()
 * @method self setBundleId(int $id)
 * @method int  getBundleId()
 * @method bool hasBundleId()
 * @method self setRenterRole(RenterRole $role)
 */
final class CreateRequestRenterDTO extends CamelDataTransferObject
{
	/** {@inheritdoc} */
	protected array $fields = [
		'requestId',
		'landlordId',
		'renterId',
		'bundleId',
		'renterRole',
	];
}
