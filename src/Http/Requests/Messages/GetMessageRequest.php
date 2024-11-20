<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Messages;

use Perscom\Http\Requests\AbstractGetRequest;

class GetMessageRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'messages';
    }
}
