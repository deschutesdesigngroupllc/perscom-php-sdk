<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Calendars;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateCalendarRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'calendars';
    }
}
