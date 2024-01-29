<?php

namespace Perscom\Http\Requests\Users\QualificationRecords;

use Perscom\Http\Requests\AbstractRelationalUpdateRequest;

class UpdateUserQualificationRecordRequest extends AbstractRelationalUpdateRequest
{
    /**
     * @param int $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/qualification-records";
    }
}
