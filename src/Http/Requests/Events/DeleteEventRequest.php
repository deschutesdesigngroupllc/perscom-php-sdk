<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Events;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteEventRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'events';
    }
}
