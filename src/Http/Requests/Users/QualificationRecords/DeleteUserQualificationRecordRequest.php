<?php

namespace Perscom\Http\Requests\Users\QualificationRecords;

use Perscom\Http\Requests\AbstractRelationalDeleteRequest;

class DeleteUserQualificationRecordRequest extends AbstractRelationalDeleteRequest
{
    /**
     * @param  int  $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/qualification-records";
    }
}
