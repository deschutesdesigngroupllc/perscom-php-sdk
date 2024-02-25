<?php

namespace Perscom\Http\Requests\Users\AssignmentRecords;

use Perscom\Http\Requests\AbstractRelationalCreateRequest;

class CreateUserAssignmentRecordRequest extends AbstractRelationalCreateRequest
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
