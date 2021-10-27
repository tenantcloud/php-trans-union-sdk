<?php

return [
	'bundles' => [
		'credit' => [
			'id' => env('TRANS_UNION_CREDIT_BUNDLE_ID', 5003),
		],
		'criminal' => [
			'id' => env('TRANS_UNION_CRIMINAL_BUNDLE_ID', 5003),
		],
		'eviction' => [
			'id' => env('TRANS_UNION_EVICTION_BUNDLE_ID', 5003),
		],
	]
];
