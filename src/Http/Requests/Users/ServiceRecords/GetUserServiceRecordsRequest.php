<?php

namespace Perscom\Http\Requests\Users\ServiceRecords;

use Perscom\Http\Requests\AbstractRelationalGetAllRequest;

class GetUserServiceRecordsRequest extends AbstractRelationalGetAllRequest
{
    /**
     * @param int $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/service-records";
    }
}
