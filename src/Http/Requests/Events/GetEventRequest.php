<?php

namespace Perscom\Http\Requests\Events;

use Perscom\Http\Requests\AbstractGetRequest;

class GetEventRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'events';
    }
}
