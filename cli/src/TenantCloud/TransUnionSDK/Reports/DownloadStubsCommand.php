<?php

namespace Dev\TenantCloud\TransUnionSDK\Reports;

use Carbon\Carbon;
use Dev\TenantCloud\TransUnionSDK\Reports\ReportStubDownloader\PersonDTO;
use Generator;
use Illuminate\Console\Command;
use TenantCloud\TransUnionSDK\Reports\ReportProduct;

class DownloadStubsCommand extends Command
{
	/**
	 * @inheritdoc
	 */
	protected $signature = 'trans-union:reports:download-stubs {--force : Download and overwrite existing reports}';

	/**
	 * @inheritdoc
	 */
	protected $description = 'Downloads all JSON report stubs.';

	public function handle(ReportStubDownloader $reportStubDownloader): void
	{
		foreach ($reportStubDownloader->downloadAll($this->people(), (bool) $this->option('force')) as [$person, $product]) {
			/** @var PersonDTO $person */
			$this->info("Downloaded {$product->value} report for {$person->firstName} {$person->lastName}");
		}

		$this->info('Done!');
	}

	/**
	 * @return Generator<array{array<ReportProduct>, PersonDTO, string} | array{array<ReportProduct>, PersonDTO}>
	 */
	private function people(): Generator
	{
		yield [
			[ReportProduct::CREDIT],
			new PersonDTO(
				'Chapoton',
				'John',
				Carbon::createFromDate(1970, 8, 15),
				'666221955'
			),
			'default'
		];

		yield [
			[ReportProduct::CRIMINAL],
			new PersonDTO(
				'Jacfirst',
				'Beclast',
				Carbon::createFromDate(1970, 8, 15),
				'999010001'
			),
			'default'
		];

		yield [
			[ReportProduct::EVICTION],
			new PersonDTO(
				'Test',
				'Tenant',
				Carbon::createFromDate(1940, 1, 1),
				'999912345'
			),
			'default'
		];

		yield [
			[ReportProduct::INCOME_INSIGHTS],
			new PersonDTO(
				'Mohammad',
				'Chowdhury',
				Carbon::createFromDate(1980, 1, 1),
				'666841546',
				income: 30000,
			),
			'default',
		];

		yield [
			[ReportProduct::CREDIT, ReportProduct::CRIMINAL, ReportProduct::EVICTION, ReportProduct::INCOME_INSIGHTS],
			new PersonDTO(
				'William',
				'Thorne',
				Carbon::createFromDate(1920, 1, 1),
				'666622631',
				income: 9999999,
			)
		];

		yield [
			[ReportProduct::CREDIT, ReportProduct::CRIMINAL, ReportProduct::EVICTION],
			new PersonDTO(
				'Bonnie',
				'Adams',
				Carbon::createFromDate(1947, 3, 6),
				'666603693'
			)
		];

		yield [
			[ReportProduct::CREDIT],
			new PersonDTO(
				'BIRMINGHAM',
				'BOB',
				Carbon::createFromDate(1920, 1, 1),
				'899522949'
			)
		];

		yield [
			[ReportProduct::CREDIT],
			new PersonDTO(
				'LINDA',
				'FRADE',
				Carbon::createFromDate(1920, 1, 1),
				'666583686'
			)
		];

		yield [
			[ReportProduct::CREDIT],
			new PersonDTO(
				'RUDOLPH',
				'LEVARITY',
				Carbon::createFromDate(1920, 1, 1),
				'666351115'
			)
		];

		yield [
			[ReportProduct::CREDIT],
			new PersonDTO(
				'MICHAEL',
				'REUSH',
				Carbon::createFromDate(1920, 1, 1),
				'666635461'
			)
		];

		yield [
			[ReportProduct::CREDIT],
			new PersonDTO(
				'MELISSA',
				'LECKENBY',
				Carbon::createFromDate(1920, 1, 1),
				'666449270'
			)
		];

		yield [
			[ReportProduct::CREDIT],
			new PersonDTO(
				'JOSEPH',
				'RAMEY',
				Carbon::createFromDate(1920, 1, 1),
				'666258078'
			)
		];

		yield [
			[ReportProduct::CREDIT],
			new PersonDTO(
				'WILLIAM',
				'LYNCH',
				Carbon::createFromDate(1920, 1, 1),
				'666279480'
			)
		];

		yield [
			[ReportProduct::CREDIT],
			new PersonDTO(
				'RAZILI',
				'DATTA',
				Carbon::createFromDate(1920, 1, 1),
				'666348817'
			)
		];

		yield [
			[ReportProduct::CREDIT],
			new PersonDTO(
				'DIANE',
				'CARSON',
				Carbon::createFromDate(1920, 1, 1),
				'666164747'
			)
		];

		yield [
			[ReportProduct::CRIMINAL],
			new PersonDTO(
				'Bugs',
				'Bunny',
				Carbon::createFromDate(1956, 1, 1),
				'999999321'
			)
		];

		yield [
			[ReportProduct::CRIMINAL],
			new PersonDTO(
				'Spongebob',
				'Squarepants',
				Carbon::createFromDate(1987, 1, 1),
				'999998321'
			)
		];

		yield [
			[ReportProduct::CRIMINAL],
			new PersonDTO(
				'Achilles',
				'Heel',
				Carbon::createFromDate(1927, 1, 1),
				'999990328'
			)
		];

		yield [
			[ReportProduct::CRIMINAL],
			new PersonDTO(
				'Ivan',
				'TheTerrible',
				Carbon::createFromDate(1928, 1, 1),
				'999990329'
			)
		];

		yield [
			[ReportProduct::CRIMINAL],
			new PersonDTO(
				'Sherlock',
				'Holmes',
				Carbon::createFromDate(1929, 1, 1),
				'999942345'
			)
		];

		yield [
			[ReportProduct::CRIMINAL],
			new PersonDTO(
				'Mountain',
				'Lion',
				Carbon::createFromDate(1927, 1, 1),
				'999990332'
			)
		];

		yield [
			[ReportProduct::CRIMINAL],
			new PersonDTO(
				'Polar',
				'Bear',
				Carbon::createFromDate(1940, 1, 1),
				'999990331'
			)
		];

		yield [
			[ReportProduct::EVICTION],
			new PersonDTO(
				'Mountain',
				'Lion',
				Carbon::createFromDate(1932, 1, 1),
				'999990332'
			)
		];

		yield [
			[ReportProduct::EVICTION],
			new PersonDTO(
				'Bald',
				'Eagle',
				Carbon::createFromDate(1933, 1, 1),
				'999990333'
			)
		];

		yield [
			[ReportProduct::EVICTION],
			new PersonDTO(
				'Emporer',
				'Penguin',
				Carbon::createFromDate(1934, 1, 1),
				'999990334'
			)
		];

		yield [
			[ReportProduct::EVICTION],
			new PersonDTO(
				'Ard',
				'Vark',
				Carbon::createFromDate(1935, 1, 1),
				'999990335'
			)
		];

		yield [
			[ReportProduct::EVICTION],
			new PersonDTO(
				'Siren',
				'Yilmaz',
				Carbon::createFromDate(1980, 1, 1),
				'666773486'
			)
		];

		yield [
			[ReportProduct::INCOME_INSIGHTS],
			new PersonDTO(
				'Thin',
				'File',
				Carbon::createFromDate(1999, 1, 1),
				'123123123',
				income: 9999999,
			)
		];
	}
}
