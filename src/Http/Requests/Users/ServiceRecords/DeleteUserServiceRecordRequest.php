<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\ServiceRecords;

use Perscom\Http\Requests\AbstractRelationalDeleteRequest;

class DeleteUserServiceRecordRequest extends AbstractRelationalDeleteRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/service-records";
    }
}
