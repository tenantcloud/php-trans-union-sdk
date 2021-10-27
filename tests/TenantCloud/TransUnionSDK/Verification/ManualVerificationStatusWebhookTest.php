<?php

namespace Tests\TenantCloud\TransUnionSDK\Verification;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use TenantCloud\TransUnionSDK\Verification\ManualVerificationController;
use TenantCloud\TransUnionSDK\Verification\ManualVerificationStatus;
use TenantCloud\TransUnionSDK\Verification\VerificationStatusChangedEvent;
use TenantCloud\TransUnionSDK\Webhooks\WhitelistMiddleware;
use Tests\TenantCloud\TransUnionSDK\TestCase;

/**
 * @see ManualVerificationController
 */
class ManualVerificationStatusWebhookTest extends TestCase
{
	private Router $router;

	private Route $route;

	protected function setUp(): void
	{
		parent::setUp();

		$this->router = $this->app->make(Router::class);
		$this->route = $this->router
			->getRoutes()
			->getByName('trans_union.webhooks.manual_verification.status');
	}

	public function testUsesIpWhitelistMiddleware(): void
	{
		$this->assertContains(WhitelistMiddleware::class, $this->router->gatherRouteMiddleware($this->route));
	}

	public function testEmitsAnEvent(): void
	{
		$this->withoutMiddleware();

		Event::fake();

		$this
			->postJson($this->route->uri(), [
				'ScreeningRequestRenterId'   => 123,
				'ManualAuthenticationStatus' => 'UserAuthenticated',
			])
			->assertNoContent();

		Event::assertDispatched(VerificationStatusChangedEvent::class, function (VerificationStatusChangedEvent $event) {
			return $event->screeningRequestRenterId === 123 &&
				$event->status === ManualVerificationStatus::$AUTHENTICATED;
		});
	}
}
