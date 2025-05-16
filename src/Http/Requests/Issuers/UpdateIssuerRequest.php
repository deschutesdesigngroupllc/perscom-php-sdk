<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Issuers;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateIssuerRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'issuers';
    }
}
