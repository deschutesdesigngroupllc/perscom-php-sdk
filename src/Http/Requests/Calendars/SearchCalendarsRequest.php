<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Calendars;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchCalendarsRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'calendars';
    }
}
