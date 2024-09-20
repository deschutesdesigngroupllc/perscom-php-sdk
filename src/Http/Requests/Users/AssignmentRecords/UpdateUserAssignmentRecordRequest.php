<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\AssignmentRecords;

use Perscom\Http\Requests\AbstractRelationalUpdateRequest;

class UpdateUserAssignmentRecordRequest extends AbstractRelationalUpdateRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/assignment-records";
    }
}
