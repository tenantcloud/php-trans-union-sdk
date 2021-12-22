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

	public ?string $suffix;

	public ?string $stateKey;

	public ?string $sourceState;

	public ?string $state;

	public ?Carbon $releaseDate;

	public ?string $recordId;

	public ?string $postalCode;

	public ?string $plaintiff;

	public ?string $middleName;

	public ?string $lastName;

	public ?string $firstName;

	public ?string $filingType;

	public ?Carbon $filingDate;

	public ?string $fileNumber;

	/** @var Event[] */
	public ?array $events;

	public ?string $datasetDescription;

	public ?string $county;

	public ?string $comments;

	public ?string $city;

	public ?string $amount;

	public ?string $address2;

	public ?string $address1;

	public ?string $actionType;

	/**
	 * @param Event[] $events
	 */
	public function __construct(
		?string $actionType,
		?string $address1,
		?string $address2,
		?string $amount,
		?string $city,
		?string $comments,
		?string $county,
		?string $datasetDescription,
		?array $events,
		?string $fileNumber,
		?Carbon $filingDate,
		?string $filingType,
		?string $firstName,
		?string $lastName,
		?string $middleName,
		?string $plaintiff,
		?string $postalCode,
		?string $recordId,
		?Carbon $releaseDate,
		?string $state,
		?string $sourceState,
		?string $stateKey,
		?string $suffix
	) {
		$this->actionType = $actionType;
		$this->address1 = $address1;
		$this->address2 = $address2;
		$this->amount = $amount;
		$this->city = $city;
		$this->comments = $comments;
		$this->county = $county;
		$this->datasetDescription = $datasetDescription;
		$this->events = $events;
		$this->fileNumber = $fileNumber;
		$this->filingDate = $filingDate;
		$this->filingType = $filingType;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->middleName = $middleName;
		$this->plaintiff = $plaintiff;
		$this->postalCode = $postalCode;
		$this->recordId = $recordId;
		$this->releaseDate = $releaseDate;
		$this->state = $state;
		$this->sourceState = $sourceState;
		$this->stateKey = $stateKey;
		$this->suffix = $suffix;
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
