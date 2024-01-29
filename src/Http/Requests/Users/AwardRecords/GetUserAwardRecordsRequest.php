<?php

namespace Perscom\Http\Requests\Users\AwardRecords;

use Perscom\Http\Requests\AbstractRelationalGetAllRequest;

class GetUserAwardRecordsRequest extends AbstractRelationalGetAllRequest
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
