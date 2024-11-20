<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Messages;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateMessageRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'messages';
    }
}
