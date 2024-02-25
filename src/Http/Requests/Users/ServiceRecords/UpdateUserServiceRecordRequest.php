<?php

namespace Perscom\Http\Requests\Users\ServiceRecords;

use Perscom\Http\Requests\AbstractRelationalUpdateRequest;

class UpdateUserServiceRecordRequest extends AbstractRelationalUpdateRequest
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
