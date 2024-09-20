<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Events;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchEventsRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'events';
    }
}
