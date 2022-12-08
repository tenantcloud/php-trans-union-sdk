<?php

namespace TenantCloud\TransUnionSDK\Shared\ArraySerializationHack;

class ArraySerializationConfig
{
	/** @var callable(string): string */
	public $serializedName;

	/**
	 * @param callable(string): string $serializedName
	 * @param array<string, string>    $arrays
	 * @param array<string, array{callable | null, callable | null}|array{callable}> $custom
	 */
	public function __construct(
		callable $serializedName,
		public array $arrays = [],
		public array $custom = []
	) {
		$this->serializedName = $serializedName;
	}

	/**
	 * @param array<string, string> $custom
	 *
	 * @return callable(string): string
	 */
	public static function pascalSerializedName(array $custom = []): callable
	{
		return fn (string $propertyName) => $custom[$propertyName] ?? ucfirst($propertyName);
	}

	public static function camelSerializedName(): callable
	{
		return fn (string $propertyName) => lcfirst($propertyName);
	}

	/**
	 * @return array{callable(mixed): mixed, callable(mixed): mixed}
	 */
	public static function mixedCustomSerializer(): array
	{
		return [
			fn ($data) => $data,
			fn ($data) => $data,
		];
	}
}
