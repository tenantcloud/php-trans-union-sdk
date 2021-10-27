<?php

namespace Tests\TenantCloud\TransUnionSDK\Reports;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use TenantCloud\TransUnionSDK\Reports\ReportDeliveryStatus;
use TenantCloud\TransUnionSDK\Reports\ReportDeliveryStatusChangedEvent;
use TenantCloud\TransUnionSDK\Reports\ReportStatusController;
use TenantCloud\TransUnionSDK\Webhooks\WhitelistMiddleware;
use Tests\TenantCloud\TransUnionSDK\TestCase;

/**
 * @see ReportStatusController::store()
 */
class ReportStatusWebhookTest extends TestCase
{
	private Router $router;

	private Route $route;

	protected function setUp(): void
	{
		parent::setUp();

		$this->router = $this->app->make(Router::class);
		$this->route = $this->router
			->getRoutes()
			->getByName('trans_union.webhooks.reports.status');
	}

	public function testUsesIpWhitelistMiddleware(): void
	{
		$this->assertContains(WhitelistMiddleware::class, $this->router->gatherRouteMiddleware($this->route));
	}

	/**
	 * @dataProvider emitsAnEventProvider
	 */
	public function testEmitsAnEvent(ReportDeliveryStatus $status): void
	{
		$this->withoutMiddleware();

		Event::fake();

		$this
			->postJson($this->route->uri(), [
				'ScreeningRequestRenterId' => 123,
				'ReportsDeliveryStatus'    => $status->value(),
			])
			->assertNoContent();

		Event::assertDispatched(ReportDeliveryStatusChangedEvent::class, function (ReportDeliveryStatusChangedEvent $event) use ($status) {
			return $event->screeningRequestRenterId === 123 &&
				$event->status === $status;
		});
	}

	/**
	 * @return array<array{ReportDeliveryStatus}>
	 */
	public function emitsAnEventProvider(): array
	{
		return array_map(fn (ReportDeliveryStatus $status) => [$status], ReportDeliveryStatus::items());
	}
}
