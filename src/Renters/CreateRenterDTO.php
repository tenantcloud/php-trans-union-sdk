<?php

namespace TenantCloud\TransUnionSDK\Renters;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Shared\EmploymentStatus;
use TenantCloud\TransUnionSDK\Shared\IncomeFrequency;

/**
 * @method CreateRenterPersonDTO getPerson()
 * @method self                  setIncome(float $amount)
 * @method float                 getIncome()
 * @method IncomeFrequency       getIncomeFrequency()
 * @method self                  setOtherIncome(float $amount)
 * @method float                 getOtherIncome()
 * @method self                  setAssets(float $amount)
 * @method IncomeFrequency       getOtherIncomeFrequency()
 * @method float                 getAssets()
 * @method EmploymentStatus      getEmploymentStatus()
 */
final class CreateRenterDTO extends CamelDataTransferObject
{
	protected array $fields = [
		'person',
		'income',
		'incomeFrequency',
		'otherIncome',
		'otherIncomeFrequency',
		'assets',
		'employmentStatus',
	];

	/**
	 * @param CreateRenterPersonDTO|array<string, mixed> $data
	 */
	public function setPerson(array|CreateRenterPersonDTO $data): self
	{
		return $this->set('person', CreateRenterPersonDTO::from($data));
	}

	public function setIncomeFrequency(IncomeFrequency|string $frequency): self
	{
		return $this->set('incomeFrequency', $frequency instanceof IncomeFrequency ? $frequency : IncomeFrequency::from($frequency));
	}

	public function setOtherIncomeFrequency(IncomeFrequency|string $frequency): self
	{
		return $this->set('otherIncomeFrequency', $frequency instanceof IncomeFrequency ? $frequency : IncomeFrequency::from($frequency));
	}

	public function setEmploymentStatus(EmploymentStatus|string $status): self
	{
		return $this->set('employmentStatus', $status instanceof EmploymentStatus ? $status : EmploymentStatus::from($status));
	}
}
