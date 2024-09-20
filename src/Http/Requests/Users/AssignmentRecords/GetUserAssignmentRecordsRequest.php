<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\AssignmentRecords;

use Perscom\Http\Requests\AbstractRelationalGetAllRequest;

class GetUserAssignmentRecordsRequest extends AbstractRelationalGetAllRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/assignment-records";
    }
}
