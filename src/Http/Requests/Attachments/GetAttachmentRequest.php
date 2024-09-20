<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Attachments;

use Perscom\Http\Requests\AbstractGetRequest;

class GetAttachmentRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'attachments';
    }
}
