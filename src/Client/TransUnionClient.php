<?php

namespace TenantCloud\TransUnionSDK\Client;

use TenantCloud\TransUnionSDK\Exams\ExamsApi;
use TenantCloud\TransUnionSDK\Landlords\LandlordsApi;
use TenantCloud\TransUnionSDK\Properties\PropertiesApi;
use TenantCloud\TransUnionSDK\Renters\RentersApi;
use TenantCloud\TransUnionSDK\Reports\ReportsApi;
use TenantCloud\TransUnionSDK\Requests\RequestsApi;
use TenantCloud\TransUnionSDK\Tokens\TokensApi;

/**
 * TransUnion API client.
 */
interface TransUnionClient
{
	/**
	 * Whether the client is currently in "test mode" or not.
	 */
	public function isTestMode(): bool;

	/**
	 * @see ExamsApi
	 */
	public function exams(): ExamsApi;

	/**
	 * @see LandlordsApi
	 */
	public function landlords(): LandlordsApi;

	/**
	 * @see RentersApi
	 */
	public function renters(): RentersApi;

	/**
	 * @see PropertiesApi
	 */
	public function properties(): PropertiesApi;

	/**
	 * @see RequestsApi
	 */
	public function requests(): RequestsApi;

	/**
	 * @see ReportsApi
	 */
	public function reports(): ReportsApi;

	/**
	 * @see TokensApi
	 */
	public function tokens(): TokensApi;
}
