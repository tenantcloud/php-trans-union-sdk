<?php

namespace TenantCloud\TransUnionSDK\Shared;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionProperty;

/**
 * This is a parody of a serializer, but it's still better than serializing everything by hand.
 */
trait MostlyArraySerializable
{
	protected static function mostlyFromArray(array $data): Collection
	{
	}

	protected function mostlyToArray(array $arrays): Collection
	{
		return $this->properties()
			->mapWithKeys(function (array $data) {
				/** @var ReflectionProperty $property */
				[$property, $serializedName] = $data;

				$value = $property->getValue($this);

				if ($property->getType()) {
					if (is_a($property->getType()->getName(), Carbon::class)) {
						$value = $value->toISOString();
					}

					if (is_a($property->getType()->getName(), ArraySerializable::class)) {
						$value = $value->toArray();
					}
				}

				return [
					$serializedName => $value,
				];
			});
	}

	private function properties(): Collection
	{
		return
			collect(
				(new ReflectionClass($this))->getProperties()
			)->filter(
				fn (ReflectionProperty $property) => $property->hasType()
			)->map(
				fn (ReflectionProperty $property) => [
					$property,
					Str::ucfirst($property->getName()),
				],
			);
	}
}
