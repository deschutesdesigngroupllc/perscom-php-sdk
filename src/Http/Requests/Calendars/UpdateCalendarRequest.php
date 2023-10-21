<?php

namespace Perscom\Http\Requests\Calendars;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateCalendarRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'calendars';
    }
}
