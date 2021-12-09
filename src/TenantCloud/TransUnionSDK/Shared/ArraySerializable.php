<?php

namespace TenantCloud\TransUnionSDK\Shared;

interface ArraySerializable
{
	public static function fromArray(array $data): self;

	public function toArray(): array;
}
