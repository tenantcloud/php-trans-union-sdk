<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Criminal;

final class Disclaimer
{
	public string $value;

	public string $key;

	public function __construct(
		string $key,
		string $value
	) {
		$this->key = $key;
		$this->value = $value;
	}
}