<?php

namespace Perscom\Http\Requests\Users\ServiceRecords;

use Perscom\Http\Requests\AbstractRelationalGetRequest;

class GetUserServiceRecordRequest extends AbstractRelationalGetRequest
{
    /**
     * @param  int  $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/service-records";
    }
}
