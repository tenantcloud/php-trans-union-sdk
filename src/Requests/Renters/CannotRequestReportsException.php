<?php

namespace TenantCloud\TransUnionSDK\Requests\Renters;

use Exception;

/**
 * Thrown when you try to request reports for an already "requested" or canceled request.
 */
final class CannotRequestReportsException extends Exception {}
