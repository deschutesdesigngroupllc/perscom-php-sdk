<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\Attachments;

use Perscom\Http\Requests\AbstractRelationalGetRequest;

class GetUserAttachmentRequest extends AbstractRelationalGetRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/attachments";
    }
}
