<?php

namespace Perscom\Http\Requests\Calendars;

use Perscom\Http\Requests\AbstractGetRequest;

class GetCalendarRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'calendars';
    }
}
