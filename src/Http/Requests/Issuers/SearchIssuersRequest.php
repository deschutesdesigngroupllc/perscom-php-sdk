<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Issuers;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchIssuersRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'issuers';
    }
}
