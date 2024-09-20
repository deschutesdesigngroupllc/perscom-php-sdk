<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Submissions\Statuses;

use Perscom\Http\Requests\AbstractRelationalAttachRequest;

class AttachSubmissionStatusRequest extends AbstractRelationalAttachRequest
{
    protected function getResource(int $relationId): string
    {
        return "submissions/$relationId/statuses";
    }
}
