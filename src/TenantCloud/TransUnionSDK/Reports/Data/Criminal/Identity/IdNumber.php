<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal\Identity;

final class IdNumber
{
	public string $typeText;

	public string $identityNumber;

	public string $idNumberType;

	public function __construct(
		string $idNumberType,
		string $identityNumber,
		string $typeText
	) {
		$this->idNumberType = $idNumberType;
		$this->identityNumber = $identityNumber;
		$this->typeText = $typeText;
	}
}
