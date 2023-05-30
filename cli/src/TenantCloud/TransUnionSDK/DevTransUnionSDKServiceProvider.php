<?php

namespace Dev\TenantCloud\TransUnionSDK;

use Dev\TenantCloud\TransUnionSDK\Reports\DownloadStubsCommand;
use Dev\TenantCloud\TransUnionSDK\Reports\ReportStubDownloader;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use TenantCloud\TransUnionSDK\Client\TransUnionClient;

class DevTransUnionSDKServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../../../../resources/trans_union.php',
			'trans_union'
		);

		$config = $this->app->make(Repository::class);

		$this->app->singleton(
			ReportStubDownloader::class,
			fn () => new ReportStubDownloader(
				$this->app->make(TransUnionClient::class),
				$this->app->make(Filesystem::class),
				$config->get('trans_union.bundles.credit.id'),
				$config->get('trans_union.bundles.criminal.id'),
				$config->get('trans_union.bundles.eviction.id'),
				$config->get('trans_union.bundles.income_insights.id'),
			)
		);
	}

	public function boot(): void
	{
		if ($this->app->runningInConsole()) {
			$this->commands([
				DownloadStubsCommand::class,
			]);
		}
	}
}
