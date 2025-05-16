<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Credentials;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateCredentialRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'credentials';
    }
}
