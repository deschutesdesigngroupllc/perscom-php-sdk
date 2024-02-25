<?php

namespace Perscom\Http\Requests\Users\AwardRecords;

use Perscom\Http\Requests\AbstractRelationalGetRequest;

class GetUserAwardRecordRequest extends AbstractRelationalGetRequest
{
    /**
     * @param  int  $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/award-records";
    }
}
