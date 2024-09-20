<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Submissions\Statuses;

use Perscom\Http\Requests\AbstractRelationalSyncRequest;

class SyncSubmissionStatusRequest extends AbstractRelationalSyncRequest
{
    protected function getResource(int $relationId): string
    {
        return "submissions/$relationId/statuses";
    }
}
