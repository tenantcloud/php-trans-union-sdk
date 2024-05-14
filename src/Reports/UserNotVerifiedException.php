<?php

namespace TenantCloud\TransUnionSDK\Reports;

use Exception;

/**
 * Thrown when renter is not yet verified and report can not be generated.
 */
final class UserNotVerifiedException extends Exception {}
