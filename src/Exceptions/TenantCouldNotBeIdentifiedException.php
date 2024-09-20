<?php

declare(strict_types=1);

namespace Perscom\Exceptions;

use Exception;

class TenantCouldNotBeIdentifiedException extends Exception
{
    // @phpstan-ignore-next-line
    protected $message = 'We could not identify the organization making the request. Please make sure your PERSCOM ID is correct.';
}
