<?php

namespace Tests\TenantCloud\TransUnionSDK\Property;

use TenantCloud\TransUnionSDK\Client\TransUnionClient;
use TenantCloud\TransUnionSDK\Landlords\CreateLandlordDTO;
use TenantCloud\TransUnionSDK\Properties\CreatePropertyDTO;
use TenantCloud\TransUnionSDK\Properties\PropertiesApi;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use TenantCloud\TransUnionSDK\Shared\PhoneType;
use Tests\TenantCloud\TransUnionSDK\TestCase;

class PropertyApiTest extends TestCase
{
	private TransUnionClient $client;

	private PropertiesApi $api;

	protected function setUp(): void
	{
		parent::setUp();

		$this->client = $this->app->make(TransUnionClient::class);
		$this->api = $this->client->properties();
	}

	public function testCreatesAndUpdatesALandlord(): void
	{
		$this->expectNotToPerformAssertions();

		$landlordId = $this->client
			->landlords()
			->create(
				CreateLandlordDTO::create()
					->setFirstName('As')
					->setLastName('Us')
					->setEmailAddress('dsada@ds.dsd')
					->setAcceptedTermsAndConditions(true)
					->setPhoneType(PhoneType::MOBILE)
					->setPhoneNumber('180002332883')
					->setBusinessAddress(
						AddressDTO::create()
							->setAddressLine1('12345 Lamplight Village Avenue')
							->setRegion('TX')
							->setLocality('Austin')
							->setPostalCode('78758')
							->setCountry('US')
					)
			);

		$data = CreatePropertyDTO::create()
			->setLandlordId($landlordId)
			->setPropertyName('123d')
			->setAddress(
				AddressDTO::create()
					->setAddressLine1('12345 Lamplight Village Avenue')
					->setRegion('TX')
					->setLocality('Austin')
					->setPostalCode('78758')
					->setCountry('US')
			);

		$id = $this->api->create(clone $data);
		$this->api->update($id, clone $data);
	}
}
