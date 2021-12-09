<?php

namespace TenantCloud\TransUnionSDK\Shared\ArraySerializationHack;

class ArraySerializationConfig
{
	/** @var callable(string): string */
	public $serializedName;

	/** @var array<string, string> */
	public array $arrays;

	/** @var array<string, array{callable, callable}> */
	public array $custom;

	/**
	 * @param callable(string): string                 $serializedName
	 * @param array<string, string>                    $arrays
	 * @param array<string, array{callable, callable}> $custom
	 */
	public function __construct(
		callable $serializedName,
		array $arrays = [],
		array $custom = []
	) {
		$this->serializedName = $serializedName;
		$this->arrays = $arrays;
		$this->custom = $custom;
	}

	public static function pascalSerializedName(array $custom = []): callable
	{
		return fn (string $propertyName) => $custom[$propertyName] ?? ucfirst($propertyName);
	}

	public static function camelSerializedName(): callable
	{
		return fn (string $propertyName) => lcfirst($propertyName);
	}

	public static function mixedCustomSerializer(): array
	{
		return [
			fn ($data) => $data,
			fn ($data) => $data,
		];
	}
}
