<?php

$testMode = env('TRANS_UNION_TEST_MODE', true);

return [
	'test_mode'   => $testMode,
	'fake_client' => env('TRANS_UNION_FAKE_CLIENT', false),

	'base_url' => env('TRANS_UNION_BASE_URL', 'https://rentals-api-ext.shareable.com'),

	'client_id' => env('TRANS_UNION_CLIENT_ID', 'AaAa1Aaa1a.AaaAaA1aAaAaaaaaaaA1'),
	'api_key'   => env('TRANS_UNION_API_KEY', 'a1a#1*1aAAaa1AA1#aA%AaaAaA1aa1aAaa1'),

	'webhooks' => [
		/*
		 * IP whitelist. By default, it is decided by TRANS_UNION_WEBHOOK_WHITELIST.
		 * If that isn't set, it will be disabled in test mode and enabled in non test mode.
		 */
		'enable_whitelist' => env('TRANS_UNION_WEBHOOK_WHITELIST') ?? !$testMode,

		'whitelisted_ips' => [],

		'prefix' => 'v1/trans_union',

		'imitate' => env('TRANS_UNION_IMITATE_EVENTS', true),
	],
];
