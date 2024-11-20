<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Messages;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateMessageRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'messages';
    }
}
