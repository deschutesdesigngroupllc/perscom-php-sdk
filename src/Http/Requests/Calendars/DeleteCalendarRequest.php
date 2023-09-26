<?php

namespace Perscom\Http\Requests\Calendars;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteCalendarRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * @param int $id
     */
    public function __construct(public int $id)
    {
        //
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "calendars/{$this->id}";
    }
}
