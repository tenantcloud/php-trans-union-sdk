<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record\Event;

use TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record\Event\Court\CourtAddress;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Court implements ArraySerializable
{
	use MagicArraySerializable;

	public ?string $page;

	public ?string $name;

	public ?string $book;

	public ?CourtAddress $address;

	public function __construct(
		?CourtAddress $address,
		?string $book,
		?string $name,
		?string $page
	) {
		$this->address = $address;
		$this->book = $book;
		$this->name = $name;
		$this->page = $page;
	}
}
