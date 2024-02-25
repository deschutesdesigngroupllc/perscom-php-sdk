<?php

namespace Perscom\Http\Requests\Users\QualificationRecords;

use Perscom\Http\Requests\AbstractRelationalCreateRequest;

class CreateUserQualificationRecordRequest extends AbstractRelationalCreateRequest
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
