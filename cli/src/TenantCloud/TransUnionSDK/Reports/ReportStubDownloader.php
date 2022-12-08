<?php

namespace cli\src\TenantCloud\TransUnionSDK\Reports;

use Carbon\Carbon;
use cli\src\TenantCloud\TransUnionSDK\Reports\ReportStubDownloader\PersonDTO;
use Generator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use InvalidArgumentException;
use TenantCloud\TransUnionSDK\Client\TransUnionClient;
use TenantCloud\TransUnionSDK\Exams\RequestExamDTO;
use TenantCloud\TransUnionSDK\Exams\RequestExamPersonDTO;
use TenantCloud\TransUnionSDK\Exams\SubmitExamAnswersDTO;
use TenantCloud\TransUnionSDK\Landlords\CreateLandlordDTO;
use TenantCloud\TransUnionSDK\Properties\CreatePropertyDTO;
use TenantCloud\TransUnionSDK\Renters\CreateRenterDTO;
use TenantCloud\TransUnionSDK\Renters\CreateRenterPersonDTO;
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

	public function __construct(
		private TransUnionClient $client,
		private Filesystem       $filesystem,
		private int              $creditBundleId,
		private int              $criminalBundleId,
		private int              $evictionBundleId
	) {
	}

	/**
	 * @param iterable<array{array<ReportProduct>, PersonDTO, string} | array{array<ReportProduct>, PersonDTO}> $people
	 *
	 * @return Generator<int, array{PersonDTO, ReportProduct}>
	 */
	public function downloadAll(iterable $people): Generator
	{
		$landlordId = $this->createLandlord();
		$propertyId = $this->createProperty($landlordId);

		foreach ($people as $data) {
			/** @var iterable<ReportProduct> $products */
			/** @var PersonDTO $person */
			[$products, $person] = $data;

			$identifier = $data[2] ?? $person->socialSecurityNumber;

			foreach ($products as $product) {
				$this->download(
					$landlordId,
					$propertyId,
					$identifier,
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
						->setIncomeFrequency(IncomeFrequency::PER_MONTH)
						->setOtherIncomeFrequency(IncomeFrequency::PER_MONTH)
						->setEmploymentStatus(EmploymentStatus::EMPLOYED)
				);

				yield [$person, $product];
			}
		}
	}

	private function download(
		int $landlordId,
		int $propertyId,
		string $identifier,
		ReportProduct $reportProduct,
		CreateRenterDTO $renterData
	): void {
		$bundleId = match ($reportProduct) {
			ReportProduct::CREDIT => $this->creditBundleId,
			ReportProduct::CRIMINAL => $this->criminalBundleId,
			ReportProduct::EVICTION => $this->evictionBundleId,
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

		// Get report data
		$report = $this->client
			->reports()
			->find($requestRenterId, $reportProduct);

		// Save
		$dir = __DIR__ . '/../../../../../../resources/reports/' . $identifier;
		$this->filesystem->ensureDirectoryExists($dir);
		$this->filesystem->put("{$dir}/{$reportProduct->value}.json", json_encode($report->report(), JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION | JSON_PRETTY_PRINT));
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
					->setRent(1.0)
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
