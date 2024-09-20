<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Calendars;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateCalendarRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'calendars';
    }
}
