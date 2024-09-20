<?php

declare(strict_types=1);

namespace Perscom\Exceptions;

use Exception;

class NotFoundHttpException extends Exception
{
    // @phpstan-ignore-next-line
    protected $message = 'The provided API endpoint could not be found. Please try again.';
}
