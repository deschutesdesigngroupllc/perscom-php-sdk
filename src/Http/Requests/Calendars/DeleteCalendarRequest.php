<?php

namespace Perscom\Http\Requests\Calendars;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteCalendarRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'calendars';
    }
}
