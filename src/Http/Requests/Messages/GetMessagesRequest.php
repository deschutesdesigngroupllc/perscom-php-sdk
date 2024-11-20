<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Messages;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetMessagesRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'messages';
    }
}
