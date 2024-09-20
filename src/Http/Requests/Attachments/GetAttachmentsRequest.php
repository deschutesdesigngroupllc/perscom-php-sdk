<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Attachments;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetAttachmentsRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'attachments';
    }
}
