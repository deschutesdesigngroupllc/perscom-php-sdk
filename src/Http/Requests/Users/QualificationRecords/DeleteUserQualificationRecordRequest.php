<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\QualificationRecords;

use Perscom\Http\Requests\AbstractRelationalDeleteRequest;

class DeleteUserQualificationRecordRequest extends AbstractRelationalDeleteRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/qualification-records";
    }
}
