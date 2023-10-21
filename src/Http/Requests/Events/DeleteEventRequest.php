<?php

namespace Perscom\Http\Requests\Events;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteEventRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'events';
    }
}
