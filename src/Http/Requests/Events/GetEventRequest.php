<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Events;

use Perscom\Http\Requests\AbstractGetRequest;

class GetEventRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'events';
    }
}
