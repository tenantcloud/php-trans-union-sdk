<?php

namespace TenantCloud\TransUnionSDK\Requests;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Requests\Renters\CreateRequestRenterDTO;

/**
 * @method self                         setLandlordId(int $id)
 * @method int                          getLandlordId()
 * @method bool                         hasLandlordId()
 * @method self                         setPropertyId(int $id)
 * @method int                          getPropertyId()
 * @method bool                         hasPropertyId()
 * @method self                         setInitialBundleId(int $id)
 * @method int                          getInitialBundleId()
 * @method bool                         hasInitialBundleId()
 * @method list<CreateRequestRenterDTO> getScreeningRequestRenters()
 */
final class CreateRequestDTO extends CamelDataTransferObject
{
	protected array $fields = [
		'landlordId',
		'propertyId',
		'initialBundleId',
		'screeningRequestRenters',
	];

	public function __construct()
	{
		$this->setScreeningRequestRenters([]);
	}

	/**
	 * @param list<CreateRequestRenterDTO|array<string, mixed>> $renters
	 */
	public function setScreeningRequestRenters(array $renters): self
	{
		return $this->set(
			'screeningRequestRenters',
			array_map(fn (array|CreateRequestRenterDTO $data) => CreateRequestRenterDTO::from($data), $renters),
		);
	}
}
