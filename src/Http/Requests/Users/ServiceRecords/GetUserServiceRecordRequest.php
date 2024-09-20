<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\ServiceRecords;

use Perscom\Http\Requests\AbstractRelationalGetRequest;

class GetUserServiceRecordRequest extends AbstractRelationalGetRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/service-records";
    }
}
