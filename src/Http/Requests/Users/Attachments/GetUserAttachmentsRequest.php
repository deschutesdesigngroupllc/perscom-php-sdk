<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\Attachments;

use Perscom\Http\Requests\AbstractRelationalGetAllRequest;

class GetUserAttachmentsRequest extends AbstractRelationalGetAllRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/attachments";
    }
}
