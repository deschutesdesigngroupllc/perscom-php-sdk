<?php

namespace Perscom\Http\Requests\Calendars;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetCalendarsRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'calendars';
    }
}
