<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Issuers;

use Perscom\Http\Requests\AbstractGetRequest;

class GetIssuerRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'issuers';
    }
}
