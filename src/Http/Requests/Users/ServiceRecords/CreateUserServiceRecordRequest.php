<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\ServiceRecords;

use Perscom\Http\Requests\AbstractRelationalCreateRequest;

class CreateUserServiceRecordRequest extends AbstractRelationalCreateRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/service-records";
    }
}
