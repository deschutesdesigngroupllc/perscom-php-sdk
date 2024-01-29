<?php

namespace Perscom\Http\Requests\Users\AssignmentRecords;

use Perscom\Http\Requests\AbstractRelationalUpdateRequest;

class UpdateUserAssignmentRecordRequest extends AbstractRelationalUpdateRequest
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
