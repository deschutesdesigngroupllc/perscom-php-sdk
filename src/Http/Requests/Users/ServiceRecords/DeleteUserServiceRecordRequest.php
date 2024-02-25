<?php

namespace Perscom\Http\Requests\Users\ServiceRecords;

use Perscom\Http\Requests\AbstractRelationalDeleteRequest;

class DeleteUserServiceRecordRequest extends AbstractRelationalDeleteRequest
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
