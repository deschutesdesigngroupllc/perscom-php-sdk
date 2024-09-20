<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Attachments;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteAttachmentRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'attachments';
    }
}
