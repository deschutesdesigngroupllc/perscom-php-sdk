<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Credentials;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetCredentialsRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'credentials';
    }
}
