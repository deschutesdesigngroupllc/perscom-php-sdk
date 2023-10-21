<?php

namespace Perscom\Http\Requests\Events;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateEventRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'events';
    }
}
