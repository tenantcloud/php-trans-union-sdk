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
	 * @param list<Event> $events
	 */
	public function __construct(
		public readonly ?string $actionType,
		public readonly ?string $address1,
		public readonly ?string $address2,
		public readonly ?string $amount,
		public readonly ?string $city,
		public readonly ?string $comments,
		public readonly ?string $county,
		public readonly ?string $datasetDescription,
		public readonly ?array $events,
		public readonly ?string $fileNumber,
		public readonly ?Carbon $filingDate,
		public readonly ?string $filingType,
		public readonly ?string $firstName,
		public readonly ?string $lastName,
		public readonly ?string $middleName,
		public readonly ?string $plaintiff,
		public readonly ?string $postalCode,
		public readonly ?string $recordId,
		public readonly ?Carbon $releaseDate,
		public readonly ?string $state,
		public readonly ?string $sourceState,
		public readonly ?string $stateKey,
		public readonly ?string $suffix
	) {}

	protected static function serializationConfig(): ArraySerializationConfig
	{
		return new ArraySerializationConfig(
			ArraySerializationConfig::pascalSerializedName(),
			[
				'events' => Event::class,
			],
		);
	}
}
