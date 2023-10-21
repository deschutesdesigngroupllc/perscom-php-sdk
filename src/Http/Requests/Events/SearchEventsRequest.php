<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Events;

use Perscom\RequestType\AbstractSearchRequest;

class SearchEventsRequest extends AbstractSearchRequest
{
    /**
     * @inheritDoc
     */
    protected function getResource(): string
    {
        return 'events';
    }
}
