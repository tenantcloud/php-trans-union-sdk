<?php

namespace Dev\TenantCloud\TransUnionSDK\Reports;

use Dev\TenantCloud\TransUnionSDK\Reports\ReportStubDownloader\PersonDTO;
use Illuminate\Console\Command;

class DownloadStubsCommand extends Command
{
	/**
	 * @inheritdoc
	 */
	protected $signature = 'trans-union:reports:download-stubs';

	/**
	 * @inheritdoc
	 */
	protected $description = 'Downloads all JSON report stubs.';

	public function handle(ReportStubDownloader $reportStubDownloader): void
	{
		foreach ($reportStubDownloader->downloadAll() as [$person, $product]) {
			/** @var PersonDTO $person */
			$this->info("Downloaded {$product} report for {$person->firstName} {$person->lastName}");
		}

		$this->info('Done!');
	}
}
