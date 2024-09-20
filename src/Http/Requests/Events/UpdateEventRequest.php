<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Events;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateEventRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'events';
    }
}
