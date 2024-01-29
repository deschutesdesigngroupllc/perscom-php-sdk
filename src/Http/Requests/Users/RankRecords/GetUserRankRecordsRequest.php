<?php

namespace Perscom\Http\Requests\Users\RankRecords;

use Perscom\Http\Requests\AbstractRelationalGetAllRequest;

class GetUserRankRecordsRequest extends AbstractRelationalGetAllRequest
{
    /**
     * @param int $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/rank-records";
    }
}
