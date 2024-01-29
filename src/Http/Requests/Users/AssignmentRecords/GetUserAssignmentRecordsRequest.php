<?php

namespace Perscom\Http\Requests\Users\AssignmentRecords;

use Perscom\Http\Requests\AbstractRelationalGetAllRequest;

class GetUserAssignmentRecordsRequest extends AbstractRelationalGetAllRequest
{
    /**
     * @param int $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/assignment-records";
    }
}
