<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Calendars;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetCalendarsRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'calendars';
    }
}
