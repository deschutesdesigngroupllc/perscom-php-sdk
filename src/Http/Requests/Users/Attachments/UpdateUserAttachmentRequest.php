<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\Attachments;

use Perscom\Http\Requests\AbstractRelationalUpdateRequest;

class UpdateUserAttachmentRequest extends AbstractRelationalUpdateRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/attachments";
    }
}
