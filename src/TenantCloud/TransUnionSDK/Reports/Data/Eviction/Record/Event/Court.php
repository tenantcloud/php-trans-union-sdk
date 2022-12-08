<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record\Event;

use TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record\Event\Court\CourtAddress;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Court implements ArraySerializable
{
	use MagicArraySerializable;

	public function __construct(
		public ?CourtAddress $address,
		public ?string $book,
		public ?string $name,
		public ?string $page
	) {
	}
}
