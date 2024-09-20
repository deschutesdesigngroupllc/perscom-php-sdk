<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\RankRecords;

use Perscom\Http\Requests\AbstractRelationalDeleteRequest;

class DeleteUserRankRecordRequest extends AbstractRelationalDeleteRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/rank-records";
    }
}
