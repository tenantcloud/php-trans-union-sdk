<?php

namespace TenantCloud\TransUnionSDK\Reports;

use Exception;

/**
 * Thrown when trying to access a report that isn't ready yet.
 */
final class ReportNotReadyException extends Exception {}
