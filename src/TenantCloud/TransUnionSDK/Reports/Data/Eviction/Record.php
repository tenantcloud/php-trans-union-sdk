<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Eviction;

use Carbon\Carbon;
use TenantCloud\TransUnionSDK\Reports\Data\Eviction\Record\Event;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializable;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\ArraySerializationConfig;
use TenantCloud\TransUnionSDK\Shared\ArraySerializationHack\MagicArraySerializable;

final class Record implements ArraySerializable
{
	use MagicArraySerializable;

	/**
	 * @param Event[] $events
	 */
	public function __construct(
		public ?string $actionType,
		public ?string $address1,
		public ?string $address2,
		public ?string $amount,
		public ?string $city,
		public ?string $comments,
		public ?string $county,
		public ?string $datasetDescription,
		public ?array $events,
		public ?string $fileNumber,
		public ?Carbon $filingDate,
		public ?string $filingType,
		public ?string $firstName,
		public ?string $lastName,
		public ?string $middleName,
		public ?string $plaintiff,
		public ?string $postalCode,
		public ?string $recordId,
		public ?Carbon $releaseDate,
		public ?string $state,
		public ?string $sourceState,
		public ?string $stateKey,
		public ?string $suffix
	) {
	}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'events' => Event::class,
			],
			[
				'filingDate' => [
					// 02/18/2020
					fn (Carbon $date) => $date->isoFormat('MM/DD/YYYY'),
				],
				'releaseDate' => [
					// 02/18/2020
					fn (Carbon $date) => $date->isoFormat('MM/DD/YYYY'),
				],
			]
		);
	}
}
