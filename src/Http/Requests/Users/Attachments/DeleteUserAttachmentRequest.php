<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\Attachments;

use Perscom\Http\Requests\AbstractRelationalDeleteRequest;

class DeleteUserAttachmentRequest extends AbstractRelationalDeleteRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/attachments";
    }
}
