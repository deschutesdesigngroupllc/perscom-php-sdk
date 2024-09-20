<?php

declare(strict_types=1);

namespace Perscom\Exceptions;

use Exception;

final class AuthenticationException extends Exception
{
    // @phpstan-ignore-next-line
    protected $message = 'The provided API key is incorrect. Please try again.';
}
