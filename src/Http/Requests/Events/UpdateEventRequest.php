<?php

namespace Perscom\Http\Requests\Events;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateEventRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'events';
    }
}
