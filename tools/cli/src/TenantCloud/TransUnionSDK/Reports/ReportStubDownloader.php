<?php

namespace Dev\TenantCloud\TransUnionSDK\Reports;

use Carbon\Carbon;
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
	private TransUnionClient $client;

	private Filesystem $filesystem;

	private int $creditBundleId;

	private int $criminalBundleId;

	private int $evictionBundleId;

	public function __construct(
		TransUnionClient $client,
		Filesystem $filesystem,
		int $creditBundleId,
		int $criminalBundleId,
		int $evictionBundleId
	) {
		$this->client = $client;
		$this->filesystem = $filesystem;
		$this->creditBundleId = $creditBundleId;
		$this->criminalBundleId = $criminalBundleId;
		$this->evictionBundleId = $evictionBundleId;
	}

	public function downloadAll(): void
	{
		$landlordId = $this->createLandlord();
		$propertyId = $this->createProperty($landlordId);

		$this->download(
			$landlordId,
			$propertyId,
			$this->creditBundleId,
			ReportProduct::$CREDIT,
			CreateRenterDTO::create()
				->setPerson(
					CreateRenterPersonDTO::create()
						->setFirstName('Chapoton')
						->setLastName('John')
						->setDateOfBirth(Carbon::createFromDate(1970, 8, 15))
						->setPhoneNumber('18143008317')
						->setPhoneType(PhoneType::$MOBILE)
						->setSocialSecurityNumber('666221955')
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
				->setIncomeFrequency(IncomeFrequency::$PER_MONTH)
				->setOtherIncomeFrequency(IncomeFrequency::$PER_MONTH)
				->setEmploymentStatus(EmploymentStatus::$EMPLOYED)
		);
		$this->download(
			$landlordId,
			$propertyId,
			$this->criminalBundleId,
			ReportProduct::$CRIMINAL,
			CreateRenterDTO::create()
				->setPerson(
					CreateRenterPersonDTO::create()
						->setFirstName('Jacfirst')
						->setLastName('Beclast')
						->setDateOfBirth(Carbon::createFromDate(1970, 8, 15))
						->setPhoneNumber('18143008317')
						->setPhoneType(PhoneType::$MOBILE)
						->setSocialSecurityNumber('999010001')
						->setHomeAddress(
							AddressDTO::create()
								->setAddressLine1('5001 N Interstate Ave')
								->setLocality('Portland')
								->setRegion('OR')
								->setCountry('US')
								->setPostalCode('97217')
						)
						->setAcceptedTermsAndConditions(true)
				)
				->setIncomeFrequency(IncomeFrequency::$PER_MONTH)
				->setOtherIncomeFrequency(IncomeFrequency::$PER_MONTH)
				->setEmploymentStatus(EmploymentStatus::$EMPLOYED)
		);
		$this->download(
			$landlordId,
			$propertyId,
			$this->evictionBundleId,
			ReportProduct::$EVICTION,
			CreateRenterDTO::create()
				->setPerson(
					CreateRenterPersonDTO::create()
						->setFirstName('Test')
						->setLastName('Tenant')
						->setDateOfBirth(Carbon::createFromDate(1940, 1, 1))
						->setPhoneNumber('18143008317')
						->setPhoneType(PhoneType::$MOBILE)
						->setSocialSecurityNumber('999912345')
						->setHomeAddress(
							AddressDTO::create()
								->setAddressLine1('123 Example Ave')
								->setLocality('Pleasantville')
								->setRegion('OH')
								->setCountry('US')
								->setPostalCode('99123')
						)
						->setAcceptedTermsAndConditions(true)
				)
				->setIncomeFrequency(IncomeFrequency::$PER_MONTH)
				->setOtherIncomeFrequency(IncomeFrequency::$PER_MONTH)
				->setEmploymentStatus(EmploymentStatus::$EMPLOYED)
		);
	}

	private function download(
		int $landlordId,
		int $propertyId,
		int $bundleId,
		ReportProduct $reportProduct,
		CreateRenterDTO $renterData
	): void {
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
					->setRenterRole(RenterRole::$APPLICANT)
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
		$dir = __DIR__ . '/../../../../../../resources/reports';
		$this->filesystem->ensureDirectoryExists($dir);
		$this->filesystem->put("{$dir}/{$reportProduct}.json", json_encode($report->report(), JSON_THROW_ON_ERROR));
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
					->setPhoneType(PhoneType::$MOBILE)
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
