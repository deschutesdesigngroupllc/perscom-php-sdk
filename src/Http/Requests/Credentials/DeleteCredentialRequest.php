<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Credentials;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteCredentialRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'credentials';
    }
}
