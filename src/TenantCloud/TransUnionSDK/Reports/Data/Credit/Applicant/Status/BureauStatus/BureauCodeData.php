<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status\BureauStatus;

use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class BureauCodeData implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $key;

	public ?string $description;

	public ?string $codeType;

	public ?string $codeDescription;

	public function __construct(
		?string $codeDescription,
		?string $codeType,
		?string $description,
		?string $key
	) {
		$this->codeDescription = $codeDescription;
		$this->codeType = $codeType;
		$this->description = $description;
		$this->key = $key;
	}
}
