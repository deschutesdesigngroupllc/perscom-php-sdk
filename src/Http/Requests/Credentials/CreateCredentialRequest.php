<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Credentials;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateCredentialRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'credentials';
    }
}
