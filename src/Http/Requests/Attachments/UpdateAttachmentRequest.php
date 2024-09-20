<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Attachments;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateAttachmentRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'attachments';
    }
}
