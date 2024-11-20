<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Messages;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchMessagesRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'messages';
    }
}
