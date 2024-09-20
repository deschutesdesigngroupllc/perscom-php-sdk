<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\ServiceRecords;

use Perscom\Http\Requests\AbstractRelationalUpdateRequest;

class UpdateUserServiceRecordRequest extends AbstractRelationalUpdateRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/service-records";
    }
}
