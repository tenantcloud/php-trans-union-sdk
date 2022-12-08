<?php

namespace TenantCloud\TransUnionSDK\Verification;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TenantCloud\TransUnionSDK\Verification\ManualVerificationStatusWebhookTest;

/**
 * @see ManualVerificationStatusWebhookTest
 */
final class ManualVerificationController
{
	/**
	 * Example URL: POST /v1/trans_union/manualauthentication/status
	 *
	 * @see ManualVerificationStatusWebhookTest
	 */
	public function store(Request $request): Response
	{
		event(new VerificationStatusChangedEvent(
			$request->input('ScreeningRequestRenterId'),
			ManualVerificationStatus::from($request->input('ManualAuthenticationStatus'))
		));

		return response()->noContent();
	}
}
