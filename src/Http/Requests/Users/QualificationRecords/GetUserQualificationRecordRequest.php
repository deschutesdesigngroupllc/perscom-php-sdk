<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\QualificationRecords;

use Perscom\Http\Requests\AbstractRelationalGetRequest;

class GetUserQualificationRecordRequest extends AbstractRelationalGetRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/qualification-records";
    }
}
