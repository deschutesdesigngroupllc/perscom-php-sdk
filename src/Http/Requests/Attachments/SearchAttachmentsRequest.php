<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Attachments;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchAttachmentsRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'attachments';
    }
}
