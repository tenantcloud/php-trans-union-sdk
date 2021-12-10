<?php

namespace TenantCloud\TransUnionSDK\Shared\ArraySerializationHack;

interface ArraySerializable
{
	/**
	 * @param array<mixed, mixed> $data
	 *
	 * @return static
	 */
	public static function fromArray(array $data): self;

	/**
	 * @return array<string, mixed>
	 */
	public function toArray(): array;
}
