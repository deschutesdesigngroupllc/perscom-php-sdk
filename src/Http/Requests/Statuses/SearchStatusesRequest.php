<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchStatusesRequest extends AbstractSearchRequest
{
    /**
     * {@inheritDoc}
     */
    protected function getResource(): string
    {
        return 'statuses';
    }
}
