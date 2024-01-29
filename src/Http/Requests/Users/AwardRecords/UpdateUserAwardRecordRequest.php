<?php

namespace Perscom\Http\Requests\Users\AwardRecords;

use Perscom\Http\Requests\AbstractRelationalUpdateRequest;

class UpdateUserAwardRecordRequest extends AbstractRelationalUpdateRequest
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
