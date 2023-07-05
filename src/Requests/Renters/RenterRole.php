<?php

namespace TenantCloud\TransUnionSDK\Requests\Renters;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum RenterRole: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case APPLICANT = 'Applicant';
	case CO_SIGNER = 'CoSigner';
}
