<?php

namespace Tests\TenantCloud\TransUnionSDK;

use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as BaseTestCase;
use TenantCloud\TransUnionSDK\TransUnionSDKServiceProvider;

class TestCase extends BaseTestCase
{
	use WithFaker;

	/**
	 * {@inheritDoc}
	 */
	protected function getPackageProviders($app): array
	{
		return [
			TransUnionSDKServiceProvider::class,
		];
	}
}
