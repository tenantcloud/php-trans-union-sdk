<?php

namespace TenantCloud\TransUnionSDK\Shared\ArraySerializationHack;

use BackedEnum;
use Carbon\Carbon;
use function collect;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionProperty;
use Webmozart\Assert\Assert;

/**
 * This is a parody of a serializer, but it's still better than serializing everything by hand.
 *
 * No attempts were made to make this pretty or flexible as this should be replaced by a proper serializer ASAP.
 */
trait MagicArraySerializable
{
	/**
	 * @param array<mixed, mixed> $data
	 *
	 * @return static
	 */
	public static function fromArray(array $data): self
	{
		$config = static::serializationConfig();

		/** @var Collection<int, mixed> $values */
		$values = static::constructorParameters()
			->map(function (ReflectionParameter $parameter) use ($config, $data) {
				$serializedName = ($config->serializedName)($parameter->getName());
				$value = $data[$serializedName];

				if ($value !== null) {
					/** @var callable(mixed): mixed|null $deserializer */
					$deserializer = $config->custom[$parameter->getName()][1] ?? null;

					if (!$deserializer && $parameter->getType()) {
						$type = $parameter->getType();

						assert($type instanceof ReflectionNamedType);

						$type = $type->getName();

						$deserializeWithType = function (string $type, $value) {
							if ($value === null) {
								return null;
							}

							if (is_a($type, Carbon::class, true)) {
								if ($value === 'N/A' || $value === 'XX/XX/XXXX' || $value === '') {
									return null;
								}

								return $type::parse($value);
							}

							if (is_a($type, ArraySerializable::class, true)) {
								return $type::fromArray($value);
							}

							if (is_a($type, BackedEnum::class, true)) {
								return $type::from($value);
							}

							return $value;
						};

						if ($type === 'array') {
							Assert::keyExists($config->arrays, $parameter->getName(), "Please specify array type for {$parameter->getName()} in " . static::class);

							$deserializer = fn ($value) => array_map(fn ($innerValue) => $deserializeWithType($config->arrays[$parameter->getName()], $innerValue), $value);
						} else {
							$deserializer = fn ($value) => $deserializeWithType($type, $value);
						}
					}

					Assert::notNull($deserializer, "Please specify a deserializer for {$parameter->getName()} in " . static::class);

					$value = $deserializer($value);
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

	/**
	 * @return Collection<int, ReflectionProperty>
	 */
	private static function properties(): Collection
	{
		return collect(
			(new ReflectionClass(static::class))
				->getProperties()
		);
	}

	/**
	 * @return Collection<int, ReflectionParameter>
	 */
	private static function constructorParameters(): Collection
	{
		return collect(
			(new ReflectionClass(static::class))
				->getConstructor()
				->getParameters()
		);
	}

	/**
	 * @return array<string, mixed>
	 */
	public function toArray(): array
	{
		$config = static::serializationConfig();

		return static::properties()
			->mapWithKeys(function (ReflectionProperty $property) use ($config) {
				$serializedName = ($config->serializedName)($property->getName());
				$value = $property->getValue($this);

				if ($value !== null) {
					/** @var callable(mixed): mixed|null $serializer */
					$serializer = $config->custom[$property->getName()][0] ?? null;

					if (!$serializer && $property->getType()) {
						$type = $property->getType();

						assert($type instanceof ReflectionNamedType);

						$type = $type->getName();

						$serializeWithType = function (string $type, $value) {
							if ($value === null) {
								return null;
							}

							if (is_a($type, Carbon::class, true)) {
								/** @var Carbon $value */
								// 2019-10-01T00:00:00.000000Z
								return $value->toISOString();
							}

							if (is_a($type, ArraySerializable::class, true)) {
								return $value->toArray();
							}

							if (is_a($type, BackedEnum::class, true)) {
								return $value->value;
							}

							return $value;
						};

						if ($type === 'array') {
							Assert::keyExists($config->arrays, $property->getName(), "Please specify array type for {$property->getName()} in " . static::class);

							$serializer = fn ($value) => array_map(fn ($innerValue) => $serializeWithType($config->arrays[$property->getName()], $innerValue), $value);
						} else {
							$serializer = fn ($value) => $serializeWithType($type, $value);
						}
					}

					Assert::notNull($serializer, "Please specify a serializer for {$property->getName()} in " . static::class);

					$value = $serializer($value);
				}

				return [
					$serializedName => $value,
				];
			})
			->all();
	}
}
