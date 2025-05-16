<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\TrainingRecords;

use Perscom\Http\Requests\AbstractRelationalGetAllRequest;

class GetUserTrainingRecordsRequest extends AbstractRelationalGetAllRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/training-records";
    }
}
