<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Messages;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteMessageRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'messages';
    }
}
