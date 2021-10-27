<?php

namespace TenantCloud\TransUnionSDK\Exams;

use RuntimeException;

/**
 * Thrown when exam is failed and manual verification on TU side is required.
 */
final class ManualVerificationRequiredException extends RuntimeException
{
}
