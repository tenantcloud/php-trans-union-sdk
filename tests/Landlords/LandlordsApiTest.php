<?php

namespace Tests\TenantCloud\TransUnionSDK\Landlords;

use TenantCloud\TransUnionSDK\Client\TransUnionClient;
use TenantCloud\TransUnionSDK\Landlords\CreateLandlordDTO;
use TenantCloud\TransUnionSDK\Landlords\LandlordsApi;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use TenantCloud\TransUnionSDK\Shared\PhoneType;
use Tests\TenantCloud\TransUnionSDK\TestCase;

class LandlordsApiTest extends TestCase
{
	private TransUnionClient $client;

	private LandlordsApi $api;

	protected function setUp(): void
	{
		parent::setUp();

		$this->client = $this->app->make(TransUnionClient::class);
		$this->api = $this->client->landlords();
	}

	public function testCreatesAndUpdatesALandlord(): void
	{
		$this->expectNotToPerformAssertions();

		$data = CreateLandlordDTO::create()
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
			);

		$id = $this->api->create(clone $data);
		$this->api->update($id, clone $data);
	}
}
