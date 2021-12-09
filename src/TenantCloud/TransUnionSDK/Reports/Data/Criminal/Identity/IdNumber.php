<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class IdNumber implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $typeText;

	public ?string $identityNumber;

	public ?string $idNumberType;

	public function __construct(
		?string $idNumberType,
		?string $identityNumber,
		?string $typeText
	) {
		$this->idNumberType = $idNumberType;
		$this->identityNumber = $identityNumber;
		$this->typeText = $typeText;
	}
}
