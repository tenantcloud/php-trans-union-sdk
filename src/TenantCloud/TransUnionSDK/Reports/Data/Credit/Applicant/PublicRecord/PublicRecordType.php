<?php

namespace TenantCloud\TransUnionSDK\Reports\Data\Credit\Applicant\PublicRecord;

use TenantCloud\Standard\Enum\BackedEnumExtensions;

enum PublicRecordType: string
{
	/** @use BackedEnumExtensions<string> */
	use BackedEnumExtensions;

	case BANKRUPTCIES = 'BANKRUPTCIES';
	case JUDGEMENTS = 'JUDGEMENTS';
}
