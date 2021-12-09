<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\Status\BureauStatus;

final class BureauCodeData
{
	public string $key;

	public string $description;

	public string $codeType;

	public string $codeDescription;

	public function __construct(
		string $codeDescription,
		string $codeType,
		string $description,
		string $key
	) {
		$this->codeDescription = $codeDescription;
		$this->codeType = $codeType;
		$this->description = $description;
		$this->key = $key;
	}
}
