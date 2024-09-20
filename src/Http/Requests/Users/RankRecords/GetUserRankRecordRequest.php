<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\RankRecords;

use Perscom\Http\Requests\AbstractRelationalGetRequest;

class GetUserRankRecordRequest extends AbstractRelationalGetRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/rank-records";
    }
}
