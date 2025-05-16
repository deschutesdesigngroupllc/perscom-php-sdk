<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Issuers;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteIssuerRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'issuers';
    }
}
