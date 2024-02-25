<?php

namespace Perscom\Http\Requests\Users\AssignmentRecords;

use Perscom\Http\Requests\AbstractRelationalDeleteRequest;

class DeleteUserAssignmentRecordRequest extends AbstractRelationalDeleteRequest
{
    /**
     * @param  int  $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/assignment-records";
    }
}
