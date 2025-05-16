<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Credentials;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchCredentialsRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'credentials';
    }
}
