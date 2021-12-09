<?php

namespace TenantCloud\TransUnionSDK\Shared\ArraySerializationHack;

use Carbon\Carbon;
use function collect;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionParameter;
use ReflectionProperty;
use TenantCloud\Standard\Enum\ValueEnum;
use Webmozart\Assert\Assert;

/**
 * This is a parody of a serializer, but it's still better than serializing everything by hand.
 */
trait MagicArraySerializable
{
	public static function fromArray(array $data): self
	{
		$config = static::serializationConfig();

		$values = static::constructorParameters()
			->map(function (ReflectionParameter $parameter) use ($config, $data) {
				$serializedName = ($config->serializedName)($parameter->getName());
				$value = $data[$serializedName];

				if ($value !== null) {
					$deserializeWithType = function (string $type, $value) {
						if (is_a($type, Carbon::class, true)) {
							if ($value === 'N/A' || $value === 'XX/XX/XXXX') {
								return null;
							}

							return $type::parse($value);
						}

						if (is_a($type, ArraySerializable::class, true)) {
							return $type::fromArray($value);
						}

						if (is_a($type, ValueEnum::class, true)) {
							return $type::fromValue($value);
						}

						return $value;
					};

					if ($parameter->getType()) {
						$type = $parameter->getType()->getName();

						if ($type === 'array') {
							Assert::keyExists($config->arrays, $parameter->getName(), "Please specify array type for {$parameter->getName()} in " . static::class);

							$value = array_map(fn ($innerValue) => $deserializeWithType($config->arrays[$parameter->getName()], $innerValue), $value);
						}

						$value = $deserializeWithType($type, $value);
					} else {
						Assert::keyExists($config->custom, $parameter->getName(), "Please specify custom deserializer for {$parameter->getName()} in " . static::class);

						$deserializer = $config->custom[$parameter->getName()][1];

						$value = ($deserializer)($value);
					}
				}

				return $value;
			});

		return new static(
			...$values
		);
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName()
		);
	}

	private static function properties(): Collection
	{
		return collect(
			(new ReflectionClass(static::class))
				->getProperties()
		);
	}

	private static function constructorParameters(): Collection
	{
		return collect(
			(new ReflectionClass(static::class))
				->getConstructor()
				->getParameters()
		);
	}

	public function toArray(): array
	{
		$config = static::serializationConfig();

		return static::properties()
			->mapWithKeys(function (ReflectionProperty $property) use ($config) {
				$serializedName = ($config->serializedName)($property->getName());
				$value = $property->getValue($this);

				if ($value !== null) {
					$serializeWithType = function (string $type, $value) {
						if (is_a($type, Carbon::class, true)) {
							return $value->toISOString();
						}

						if (is_a($type, ArraySerializable::class, true)) {
							return $value->toArray();
						}

						if (is_a($type, ValueEnum::class, true)) {
							return $value->value();
						}

						return $value;
					};

					if ($property->getType()) {
						$type = $property->getType()->getName();

						if ($type === 'array') {
							Assert::keyExists($config->arrays, $property->getName(), "Please specify array type for {$property->getName()} in " . static::class);

							$value = array_map(fn ($innerValue) => $serializeWithType($config->arrays[$property->getName()], $innerValue), $value);
						}

						$value = $serializeWithType($type, $value);
					} else {
						Assert::keyExists($config->custom, $property->getName(), "Please specify custom serializer for {$property->getName()} in " . static::class);

						$serializer = $config->custom[$property->getName()][0];

						$value = ($serializer)($value);
					}
				}

				return [
					$serializedName => $value,
				];
			})
			->all();
	}
}
