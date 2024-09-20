<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\AwardRecords;

use Perscom\Http\Requests\AbstractRelationalCreateRequest;

class CreateUserAwardRecordRequest extends AbstractRelationalCreateRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/award-records";
    }
}
