<?php

namespace Dev\TenantCloud\TransUnionSDK\Reports;

use Illuminate\Console\Command;

class DownloadStubsCommand extends Command
{
	/**
	 * @inheritdoc
	 */
	protected $signature = 'trans_union:reports:download_stubs';

	/**
	 * @inheritdoc
	 */
	protected $description = 'Downloads all JSON report stubs.';

	public function handle(ReportStubDownloader $reportStubDownloader): void
	{
		$reportStubDownloader->downloadAll();
	}
}
