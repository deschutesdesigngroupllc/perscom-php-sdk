<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Submissions\Statuses;

use Perscom\Http\Requests\AbstractRelationalDetachRequest;

class DetachSubmissionStatusRequest extends AbstractRelationalDetachRequest
{
    /**
     * @param  int  $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "submissions/$relationId/statuses";
    }
}
