<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Events;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateEventRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'events';
    }
}
