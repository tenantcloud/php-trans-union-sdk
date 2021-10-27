<?php

namespace TenantCloud\TransUnionSDK\Requests\Renters;

use Exception;

/**
 * Thrown when request is not cancelable yet/anymore.
 */
final class CannotCancelRequestException extends Exception
{
}
