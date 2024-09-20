<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Calendars;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteCalendarRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'calendars';
    }
}
