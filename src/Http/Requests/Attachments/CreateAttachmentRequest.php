<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Attachments;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateAttachmentRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'attachments';
    }
}
