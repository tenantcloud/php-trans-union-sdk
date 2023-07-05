<?php

namespace Tests\TenantCloud\TransUnionSDK\Shared;

use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use Tests\TenantCloud\TransUnionSDK\TestCase;

/**
 * @see AddressDTO
 */
class AddressDTOTest extends TestCase
{
	public function testReplacesSpecialCharactersInAddressLines(): void
	{
		$address = AddressDTO::create()
			->setAddressLine1('1018 1/2 Church St')
			->setAddressLine2('202-55')
			->setLocality('Milton')
			->setRegion('WV');

		self::assertSame('1018 1 2 Church St', $address->getAddressLine1());
		self::assertSame('202 55', $address->getAddressLine2());
		self::assertSame('Milton', $address->getLocality());
		self::assertSame('WV', $address->getRegion());
	}

	public function testTransliteratesAddressLinesCityAndState(): void
	{
		$address = AddressDTO::create()
			->setAddressLine1('Cañon City')
			->setAddressLine2('Hōnaunau-Nāpōʻopoʻo')
			->setAddressLine3('César Chávez')
			->setAddressLine4('Lindström')
			->setLocality('Lāwaʻi')
			->setRegion('Pākalā Village');

		self::assertSame('Canon City', $address->getAddressLine1());
		self::assertSame('Honaunau Napoʻopoʻo', $address->getAddressLine2());
		self::assertSame('Cesar Chavez', $address->getAddressLine3());
		self::assertSame('Lindstrom', $address->getAddressLine4());
		self::assertSame('Lawaʻi', $address->getLocality());
		self::assertSame('Pakala Village', $address->getRegion());
	}
}
