<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Credentials;

use Perscom\Http\Requests\AbstractGetRequest;

class GetCredentialRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'credentials';
    }
}
