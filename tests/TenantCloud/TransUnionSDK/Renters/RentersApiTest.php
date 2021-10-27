<?php

namespace Tests\TenantCloud\TransUnionSDK\Renters;

use TenantCloud\TransUnionSDK\Client\TransUnionClient;
use TenantCloud\TransUnionSDK\Renters\CreateRenterDTO;
use TenantCloud\TransUnionSDK\Renters\CreateRenterPersonDTO;
use TenantCloud\TransUnionSDK\Renters\RentersApi;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use TenantCloud\TransUnionSDK\Shared\EmploymentStatus;
use TenantCloud\TransUnionSDK\Shared\IncomeFrequency;
use TenantCloud\TransUnionSDK\Shared\PhoneType;
use Tests\TenantCloud\TransUnionSDK\TestCase;

class RentersApiTest extends TestCase
{
	private TransUnionClient $client;

	private RentersApi $api;

	protected function setUp(): void
	{
		parent::setUp();

		$this->client = $this->app->make(TransUnionClient::class);
		$this->api = $this->client->renters();
	}

	public function testCreatesAndUpdatesALandlord(): void
	{
		$this->expectNotToPerformAssertions();

		$data = CreateRenterDTO::create()
			->setPerson(
				CreateRenterPersonDTO::create()
					->setFirstName('As')
					->setLastName('Us')
					->setEmailAddress('dsada@ds.dsd')
					->setAcceptedTermsAndConditions(true)
					->setPhoneType(PhoneType::$MOBILE)
					->setPhoneNumber('180002332883')
					->setDateOfBirth(now()->subYears(19))
					->setSocialSecurityNumber('123456789')
					->setHomeAddress(
						AddressDTO::create()
							->setAddressLine1('12345 Lamplight Village Avenue')
							->setRegion('TX')
							->setLocality('Austin')
							->setPostalCode('78758')
							->setCountry('US')
					)
			)
			->setIncome(1)
			->setIncomeFrequency(IncomeFrequency::$PER_MONTH)
			->setOtherIncome(0)
			->setOtherIncomeFrequency(IncomeFrequency::$PER_MONTH)
			->setAssets(0)
			->setEmploymentStatus(EmploymentStatus::$SELF_EMPLOYED);

		$id = $this->api->create(clone $data);
		$this->api->update($id, clone $data);
	}
}
