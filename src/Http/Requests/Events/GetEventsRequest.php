<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Events;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetEventsRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'events';
    }
}
