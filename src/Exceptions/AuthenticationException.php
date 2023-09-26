<?php

namespace Perscom\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    // @phpstan-ignore-next-line
    protected $message = 'The provided API key is incorrect. Please try again.';
}
