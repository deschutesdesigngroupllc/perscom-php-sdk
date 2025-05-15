<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\TrainingRecords;

use Perscom\Http\Requests\AbstractRelationalGetRequest;

class GetUserTrainingRecordRequest extends AbstractRelationalGetRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/training-records";
    }
}
