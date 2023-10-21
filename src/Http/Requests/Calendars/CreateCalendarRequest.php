<?php

namespace Perscom\Http\Requests\Calendars;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateCalendarRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'calendars';
    }
}
