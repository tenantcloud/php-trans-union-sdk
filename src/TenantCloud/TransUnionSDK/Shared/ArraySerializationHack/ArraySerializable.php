<?php

namespace TenantCloud\TransUnionSDK\Shared\ArraySerializationHack;

interface ArraySerializable
{
	public static function fromArray(array $data): self;

	public function toArray(): array;
}
