<?php

namespace TenantCloud\TransUnionSDK\Renters;

use TenantCloud\DataTransferObjects\CamelDataTransferObject;
use TenantCloud\TransUnionSDK\Shared\EmploymentStatus;
use TenantCloud\TransUnionSDK\Shared\IncomeFrequency;

/**
 * @method CreateRenterPersonDTO getPerson()
 * @method self                  setIncome(float $amount)
 * @method self                  setOtherIncome(float $amount)
 * @method self                  setAssets(float $amount)
 */
final class CreateRenterDTO extends CamelDataTransferObject
{
	/** @inheritDoc */
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
	public function setPerson($data): self
	{
		return $this->set('person', CreateRenterPersonDTO::from($data));
	}

	/**
	 * @param string|IncomeFrequency $frequency
	 */
	public function setIncomeFrequency($frequency): self
	{
		return $this->set('incomeFrequency', IncomeFrequency::fromValue($frequency));
	}

	/**
	 * @param string|IncomeFrequency $frequency
	 */
	public function setOtherIncomeFrequency($frequency): self
	{
		return $this->set('otherIncomeFrequency', IncomeFrequency::fromValue($frequency));
	}

	/**
	 * @param string|EmploymentStatus $status
	 */
	public function setEmploymentStatus($status): self
	{
		return $this->set('employmentStatus', EmploymentStatus::fromValue($status));
	}
}
