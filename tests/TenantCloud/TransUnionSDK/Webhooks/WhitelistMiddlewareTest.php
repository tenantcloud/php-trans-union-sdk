<?php

namespace Tests\TenantCloud\TransUnionSDK\Webhooks;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use TenantCloud\TransUnionSDK\Webhooks\WhitelistMiddleware;
use Tests\TenantCloud\TransUnionSDK\TestCase;

/**
 * @see WhitelistMiddleware
 */
class WhitelistMiddlewareTest extends TestCase
{
	public function testResortsToConfigValueByDefault(): void
	{
		config([
			'trans_union.webhooks.whitelisted_ips'  => ['123.123.123.123'],
			'trans_union.webhooks.enable_whitelist' => true,
		]);

		$this->assertSame(
			123,
			$this->app
				->make(WhitelistMiddleware::class)
				->handle(
					Request::create('', 'GET', [], [], [], [
						'REMOTE_ADDR' => '123.123.123.123',
					]),
					fn () => 123
				)
		);

		$this->expectException(AuthorizationException::class);

		$this->app
			->make(WhitelistMiddleware::class)
			->handle(
				Request::create('', 'GET', [], [], [], [
					'REMOTE_ADDR' => '123.123.123.124',
				]),
				static function () {
				}
			);
	}
}
