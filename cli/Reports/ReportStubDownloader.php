<?php

namespace Dev\TenantCloud\TransUnionSDK\Reports;

use Dev\TenantCloud\TransUnionSDK\Reports\ReportStubDownloader\PersonDTO;
use Generator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use TenantCloud\TransUnionSDK\Client\TransUnionClient;
use TenantCloud\TransUnionSDK\Exams\RequestExamDTO;
use TenantCloud\TransUnionSDK\Exams\RequestExamPersonDTO;
use TenantCloud\TransUnionSDK\Exams\SubmitExamAnswersDTO;
use TenantCloud\TransUnionSDK\Landlords\CreateLandlordDTO;
use TenantCloud\TransUnionSDK\Properties\CreatePropertyDTO;
use TenantCloud\TransUnionSDK\Renters\CreateRenterDTO;
use TenantCloud\TransUnionSDK\Renters\CreateRenterPersonDTO;
use TenantCloud\TransUnionSDK\Reports\ReportFormat;
use TenantCloud\TransUnionSDK\Reports\ReportProduct;
use TenantCloud\TransUnionSDK\Reports\RequestReportDTO;
use TenantCloud\TransUnionSDK\Reports\RequestReportPersonDTO;
use TenantCloud\TransUnionSDK\Requests\CreateRequestDTO;
use TenantCloud\TransUnionSDK\Requests\Renters\CreateRequestRenterDTO;
use TenantCloud\TransUnionSDK\Requests\Renters\RenterRole;
use TenantCloud\TransUnionSDK\Shared\AddressDTO;
use TenantCloud\TransUnionSDK\Shared\EmploymentStatus;
use TenantCloud\TransUnionSDK\Shared\IncomeFrequency;
use TenantCloud\TransUnionSDK\Shared\PhoneType;
use TenantCloud\TransUnionSDK\Verification\TestModeVerificationAnswersFactory;

/**
 * Downloads reports as stubs for tests & testing TU report parsing.
 */
class ReportStubDownloader
{
	private const DIR = __DIR__ . '/../../resources/reports';

	public function __construct(
		private readonly TransUnionClient $client,
		private readonly Filesystem $filesystem,
		private readonly int $creditBundleId,
		private readonly int $criminalBundleId,
		private readonly int $evictionBundleId,
		private readonly int $incomeInsightsBundleId,
	) {}

	/**
	 * @param iterable<array{array<ReportProduct>, PersonDTO, string}|array{array<ReportProduct>, PersonDTO}> $people
	 *
	 * @return Generator<int, array{PersonDTO, ReportProduct}>
	 */
	public function downloadAll(iterable $people, bool $overwrite): Generator
	{
		$landlordId = $this->createLandlord();
		$propertyId = $this->createProperty($landlordId);

		foreach ($people as $data) {
			/** @var iterable<ReportProduct> $products */
			/** @var PersonDTO $person */
			[$products, $person] = $data;

			$set = $data[2] ?? $person->socialSecurityNumber;

			foreach ($products as $product) {
				if (!$overwrite && $this->reportsExist($set, $product)) {
					yield [$person, $product];

					continue;
				}

				$this->download(
					$landlordId,
					$propertyId,
					$set,
					$product,
					CreateRenterDTO::create()
						->setPerson(
							CreateRenterPersonDTO::create()
								->setFirstName($person->firstName)
								->setLastName($person->lastName)
								->setDateOfBirth($person->dateOfBirth)
								->setPhoneNumber('18143008317')
								->setPhoneType(PhoneType::MOBILE)
								->setSocialSecurityNumber($person->socialSecurityNumber)
								->setHomeAddress(
									AddressDTO::create()
										->setAddressLine1('5962 N Black River')
										->setLocality('Cheboygan')
										->setRegion('MI')
										->setCountry('US')
										->setPostalCode('49721')
								)
								->setAcceptedTermsAndConditions(true)
						)
						->setIncome($person->income)
						->setIncomeFrequency(IncomeFrequency::PER_YEAR)
						->setOtherIncomeFrequency(IncomeFrequency::PER_YEAR)
						->setEmploymentStatus(EmploymentStatus::EMPLOYED)
				);

				yield [$person, $product];
			}
		}
	}

	private function reportsExist(string $set, ReportProduct $reportProduct): bool
	{
		foreach ($reportProduct->supportedFormats() as $format) {
			if (!$this->filesystem->exists($this->path($set, $reportProduct, $format))) {
				return false;
			}
		}

		return true;
	}

	private function path(string $set, ReportProduct $reportProduct, ReportFormat $format): string
	{
		return self::DIR . "/{$reportProduct->value}/{$set}.{$format->value}";
	}

	private function download(
		int $landlordId,
		int $propertyId,
		string $set,
		ReportProduct $reportProduct,
		CreateRenterDTO $renterData
	): void {
		$bundleId = match ($reportProduct) {
			ReportProduct::CREDIT          => $this->creditBundleId,
			ReportProduct::CRIMINAL        => $this->criminalBundleId,
			ReportProduct::EVICTION        => $this->evictionBundleId,
			ReportProduct::INCOME_INSIGHTS => $this->incomeInsightsBundleId,
		};

		// Create renter
		$renterId = $this->client
			->renters()
			->create($renterData);

		// Create request
		$requestId = $this->client
			->requests()
			->create(
				CreateRequestDTO::create()
					->setLandlordId($landlordId)
					->setPropertyId($propertyId)
					->setInitialBundleId($bundleId)
			);
		$requestRenterId = $this->client
			->requests()
			->renters()
			->create(
				CreateRequestRenterDTO::create()
					->setLandlordId($landlordId)
					->setRenterId($renterId)
					->setRequestId($requestId)
					->setBundleId($bundleId)
					->setRenterRole(RenterRole::APPLICANT)
			);

		// Pass exam verification
		$exam = $this->client
			->exams()
			->request(
				RequestExamDTO::create()
					->setRequestRenterId($requestRenterId)
					->setPerson(
						RequestExamPersonDTO::from($renterData->getPerson()->toArray())
							->setPersonId($renterId)
					)
			);
		$this->client
			->exams()
			->submitAnswers(
				SubmitExamAnswersDTO::create()
					->setRequestRenterId($requestRenterId)
					->setExamId($exam->id())
					->setAnswers((new TestModeVerificationAnswersFactory())->correct())
			);

		// Request the report
		$this->client
			->reports()
			->request(
				RequestReportDTO::create()
					->setRequestRenterId($requestRenterId)
					->setPerson(
						RequestReportPersonDTO::from($renterData->getPerson()->toArray())
							->setPersonId($renterId)
					)
			);

		$this->filesystem->ensureDirectoryExists(self::DIR . '/' . $reportProduct->value);

		foreach ($reportProduct->supportedFormats() as $format) {
			$reportData = match ($format) {
				ReportFormat::JSON => json_encode(
					$this->client->reports()->findArray($requestRenterId, $reportProduct)->report(),
					JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION | JSON_PRETTY_PRINT
				),
				ReportFormat::HTML => $this->client->reports()->findHtml($requestRenterId, $reportProduct)->report(),
			};

			$this->filesystem->put($this->path($set, $reportProduct, $format), $reportData);
		}
	}

	private function createLandlord(): int
	{
		return $this->client
			->landlords()
			->create(
				CreateLandlordDTO::create()
					->setFirstName('Test')
					->setLastName('Landlord')
					->setEmailAddress(Str::random(32) . '@test.com')
					->setPhoneNumber('18143008317')
					->setPhoneType(PhoneType::MOBILE)
					->setBusinessName('')
					->setBusinessAddress(
						AddressDTO::create()
							->setAddressLine1('31 Palmer Lane')
							->setLocality('Carriere')
							->setRegion('MS')
							->setCountry('US')
							->setPostalCode('39426-2687')
					)
					->setAcceptedTermsAndConditions(true)
			);
	}

	private function createProperty(int $landlordId): int
	{
		return $this->client
			->properties()
			->create(
				CreatePropertyDTO::create()
					->setLandlordId($landlordId)
					->setPropertyName('Test')
					->setRent(1000.0)
					->setAddress(
						AddressDTO::create()
							->setAddressLine1('31 Palmer Lane')
							->setLocality('Carriere')
							->setRegion('MS')
							->setCountry('US')
							->setPostalCode('39426-2687')
					)
			);
	}
}
