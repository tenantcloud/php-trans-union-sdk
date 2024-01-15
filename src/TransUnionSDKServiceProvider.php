<?php

namespace TenantCloud\TransUnionSDK;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Queue\Factory as QueueConnectionFactory;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;
use TenantCloud\TransUnionSDK\Client\TransUnionClient;
use TenantCloud\TransUnionSDK\Client\TransUnionClientImpl;
use TenantCloud\TransUnionSDK\Fake\FakeTransUnionClient;
use TenantCloud\TransUnionSDK\Reports\ReportStatusController;
use TenantCloud\TransUnionSDK\Tokens\Cache\InMemoryTokenCache;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver\ApiTokenResolver;
use TenantCloud\TransUnionSDK\Tokens\TokenResolver\CachingTokenResolver;
use TenantCloud\TransUnionSDK\Verification\ManualVerificationController;
use TenantCloud\TransUnionSDK\Webhooks\WhitelistMiddleware;

/**
 * Provides TransUnion SDK and it's test/staging stuff.
 */
final class TransUnionSDKServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../resources/trans_union.php',
			'trans_union'
		);

		$this->app->bind(WhitelistMiddleware::class, function (Container $container) {
			$config = $container->make(Repository::class);

			return new WhitelistMiddleware(
				$config->get('trans_union.webhooks.whitelisted_ips'),
				$config->get('trans_union.webhooks.enable_whitelist')
			);
		});

		$this->bindDefaultClient($this->app->make(Repository::class));
	}

	public function boot(Router $router, Repository $config): void
	{
		$this->publishes([
			__DIR__ . '/../resources/trans_union.php' => config_path('trans_union.php'),
		]);

		$router->middleware(WhitelistMiddleware::class)
			->prefix($config->get('trans_union.webhooks.prefix'))
			->group(static function () use ($router) {
				$router->post('reports/status', ReportStatusController::class . '@store')
					->name('trans_union.webhooks.reports.status');
				$router->post('manualauthentication/status', ManualVerificationController::class . '@store')
					->name('trans_union.webhooks.manual_verification.status');
			});
	}

	/**
	 * Binds default implementation of {@see TransUnionClient}.
	 */
	private function bindDefaultClient(Repository $config): void
	{
		if (!$config->get('trans_union.fake_client')) {
			$this->app->singleton(TransUnionClient::class, static function (Container $container) {
				$config = $container->make(Repository::class);

				// todo: , $container->make(LaravelCacheTokenCache::class)
				return new TransUnionClientImpl(
					$config->get('trans_union.base_url'),
					$config->get('trans_union.client_id'),
					$config->get('trans_union.api_key'),
					fn (TransUnionClient $client) => new CachingTokenResolver(new ApiTokenResolver($client), $container->make(InMemoryTokenCache::class)),
					$container->make(QueueConnectionFactory::class),
					$container->make(Dispatcher::class),
					$config->get('trans_union.webhooks.imitate'),
					$config->get('trans_union.test_mode'),
					$container->make(LoggerInterface::class),
				);
			});
		} else {
			$this->app->singleton(TransUnionClient::class, FakeTransUnionClient::class);
		}
	}
}
