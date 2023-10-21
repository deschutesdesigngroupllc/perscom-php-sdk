<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Ranks;

use Perscom\RequestType\AbstractSearchRequest;

class SearchRanksRequest extends AbstractSearchRequest
{
    /**
     * @inheritDoc
     */
    protected function getResource(): string
    {
        return 'ranks';
    }
}
