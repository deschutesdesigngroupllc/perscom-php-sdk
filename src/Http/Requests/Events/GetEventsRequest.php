<?php

namespace Perscom\Http\Requests\Events;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetEventsRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'events';
    }
}
