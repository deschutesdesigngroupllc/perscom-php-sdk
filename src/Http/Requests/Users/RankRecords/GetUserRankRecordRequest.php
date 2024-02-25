<?php

namespace Perscom\Http\Requests\Users\RankRecords;

use Perscom\Http\Requests\AbstractRelationalGetRequest;

class GetUserRankRecordRequest extends AbstractRelationalGetRequest
{
    /**
     * @param  int  $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/rank-records";
    }
}
