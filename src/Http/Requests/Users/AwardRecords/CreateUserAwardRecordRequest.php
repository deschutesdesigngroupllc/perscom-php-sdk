<?php

namespace Perscom\Http\Requests\Users\AwardRecords;

use Perscom\Http\Requests\AbstractRelationalCreateRequest;

class CreateUserAwardRecordRequest extends AbstractRelationalCreateRequest
{
    /**
     * @param int $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/award-records";
    }
}
