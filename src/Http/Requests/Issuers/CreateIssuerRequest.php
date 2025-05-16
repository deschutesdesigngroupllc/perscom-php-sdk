<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Issuers;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateIssuerRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'issuers';
    }
}
