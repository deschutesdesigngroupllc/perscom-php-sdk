<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\AwardRecords;

use Perscom\Http\Requests\AbstractRelationalGetAllRequest;

class GetUserAwardRecordsRequest extends AbstractRelationalGetAllRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/award-records";
    }
}
