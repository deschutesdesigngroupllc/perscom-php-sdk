<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchAwardsRequest extends AbstractSearchRequest
{
    /**
     * {@inheritDoc}
     */
    protected function getResource(): string
    {
        return 'awards';
    }
}
