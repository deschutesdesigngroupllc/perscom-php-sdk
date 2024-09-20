<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Calendars;

use Perscom\Http\Requests\AbstractGetRequest;

class GetCalendarRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'calendars';
    }
}
