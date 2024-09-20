<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Submissions\Statuses;

use Perscom\Http\Requests\AbstractRelationalDetachRequest;

class DetachSubmissionStatusRequest extends AbstractRelationalDetachRequest
{
    protected function getResource(int $relationId): string
    {
        return "submissions/$relationId/statuses";
    }
}
