<?php

namespace TenantCloud\TransUnionSDK\Webhooks;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TenantCloud\TransUnionSDK\Webhooks\WhitelistMiddlewareTest;

/**
 * Whitelists requests from TU servers only.
 *
 * @see WhitelistMiddlewareTest
 */
final class WhitelistMiddleware
{
	/**
	 * @param array<string> $ips
	 */
	public function __construct(private array $ips, private bool $enabled = true)
	{
	}

	public function handle(Request $request, Closure $next): Response
	{
		if ($this->enabled && !in_array($request->ip(), $this->ips, true)) {
			throw new AuthorizationException();
		}

		return $next($request);
	}
}
